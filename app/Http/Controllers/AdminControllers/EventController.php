<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\LocalStorageImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendEventRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{
    use LocalStorageImage;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Event $event)
    {
        try {
            $rows_page = $request->rows_page;
            $search= $request->search;
              $events = Event::select('id', 'title', 'description', 'start_date', 'end_date', 'place', 'address', 'city', 'image', 'type', 'status')
                ->search($search)
                ->paginate($rows_page);

            return response()->json([
                'events' => $events,
                'success' => true,
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al obteber los eventos',
                'error' => $e->getMessage(),
                'success' => false,
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
    public function store(SendEventRequest $request)
    {
        try {
            $event = new Event();
            $event->fill($request->all());
            $event->status = $request->status["status"];
            $path = $this->setImage($request, 'image', 'images', 'event');
            $event->image = $path;
            $event->save();

            return response()->json([
                'event' => $event,
                'message' => 'El registro se agregó con éxito',
                'success' => true,
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al crear el evento',
                'error' => $e->getMessage(),
                'success' => false,
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SendEventRequest $request, Event $event)
    {
        try {
            $image = $event->image;
            $event->fill($request->all());
            if (!Str::isJson($request->status)) {
                $event->status = $request->status["status"];
            }
            $path = $this->updateImage($request, 'image', $image, 'images', 'event');

            $event->image = $path ?? $image;
            $event->save();
            return response()->json([
                'event' => $event,
                'success' => true,
                'message' => "El registro se actualizó con éxito",
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al actulizar el evento',
                'error' => $e->getMessage(),
                'success' => false,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
           $this->deleteImage($event, 'images');
            $event->delete();

            return response()->json([
                'event' => $event,
                'message' => 'Registro elimnado con exito',
                'success' => true,
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al eliminar el evento',
                'error' => $e->getMessage(),
                'success' => false,
            ], 404);
        }
    }
}
