<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $rows_page = $request->rows_page;
            $events = Event::select('id', 'name', 'description', 'start_date', 'end_date', 'place', 'address', 'city', 'image','type','status')->paginate($rows_page);
            return response()->json([
                'events' => $events,
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al obteber los eventos',
                'error' => $e->getMessage(),
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
            $event = new Event();
            $event->fill($request->all());
            $event->status=$request->status["code"];
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('','events');
                $event->image = $path;
            }
            $event->save();

            return response()->json([
                'event' => $event,
                'message' => 'asdfsfsdfsd dfsd sd',
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al crear el evento',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
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
    public function update(Request $request, Event $event)
    {
        try {

            $event->fill($request->all());
            $event->status=$request->status["code"];
            if($request->file('image')){
                if( !is_string($request->image ) ){
                Storage::disk('events')->delete($event->image);
              }
              $image = $request->file('image');
              $path = $image->store('','events');
              $event->image = $path;
            }
            $event->save();

            return response()->json([
                'event' => $event,
                'success' => true,
                'message'=>"El registro se agregó con éxito"
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al actulizar el evento',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            if( $event->image !=null){
              Storage::disk('events')->delete($event->image);
            }
          $event->delete();

            return response()->json([
                'success' => true
            ], 202);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al eliminar el evento',
                'error' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }
    public function getEventImage(){

    }
}
