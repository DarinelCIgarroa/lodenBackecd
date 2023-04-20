<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $messages = Message::select('id', 'full_name', 'phone_number', 'message')->get();

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
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'No se encontró el mensaje con el ID proporcionado',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }
}
