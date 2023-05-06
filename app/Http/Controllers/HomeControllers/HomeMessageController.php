<?php

namespace App\Http\Controllers\HomeControllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\Company;
use App\Models\Event;
use App\Models\Message;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HomeMessageController extends Controller
{
    public function sedEmailClient(Request $request)
    {
        try {

            $request->validate([
                'mail' => 'required|email',
                'phone_number' => 'required|numeric',
                'full_name' => 'required|string',
                'message' => 'required|min:20|max:150|string',
                'event_id' => 'required',
            ]);
            $data = $request->all();
            $message = new Message();
            $message->fill($data);
            $message->save();
            dispatch(new SendEmailJob($data));
            return response()->json([
                'success' => true,
            ], 202);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al enviar el correo',
                'success' => false,
            ]);
        }
    }
    public function getEvents()
    {
        try {
            $events = Event::select('id', 'name')->where('status', '=', '1')->get();
            return response()->json([
                'success' => true,
                'events' => $events,
            ], 202);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al obtener registros',
                'success' => false,
            ]);
        }
    }
    public function allEvents()
    {
        try {
            $all_events = Event::all();
            $all_events->makeHidden(['updated_at', 'created_at']);
            return response()->json([
                'success' => true,
                'events' => $all_events,
            ], 202);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al obtener registros',
                'success' => false,
            ]);
        }
    }
    public function eventsActive()
    {
        try {
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'message' => 'Error al obtener registros',
                'success' => false,
            ]);
        }
    }

    public function getDataHomeCompany()
    {
        try {
            $company = Company::select('name', 'logo')->first();

            return response()->json([
                'company' => $company,
                'success' => true,
            ], 202);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al obtener registros',
                'success' => false,
            ]);
        }
    }
}
