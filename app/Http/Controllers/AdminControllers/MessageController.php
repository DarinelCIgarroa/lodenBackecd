<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $rows_page = $request->rows_page;

            $messages = Message::with(['event' => function ($query) {
                $query->select('id', 'title', 'start_date', 'end_date');
            }])->select('id', 'full_name', 'phone_number', 'message', 'mail', 'event_id', 'created_at')
                ->paginate($rows_page);

            return response()->json([
                'messages' => $messages,
                'success' => true
            ], 202);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $message = new Message();
            $message->fill($request->all());
            $message->save();

            return response()->json([
                'message' => $message,
                'success' => true
            ], 202);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        try {
            $message->fill($request->all());
            $message->save();

            return response()->json([
                'message' => $message,
                'success' => true
            ], 202);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al actulizar el mensaje',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        try {
            $message->delete();

            return response()->json([
                'message' => 'Registro elimnado con exito',
                'messageItem' => $message,
                'success' => true
            ], 202);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al eliminar el registro',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }
}
