<?php

namespace App\Http\Controllers\HomeControllers;


use App\Models\Team;
use App\Models\Event;
use App\Models\Company;
use App\Models\Message;
use App\Jobs\SendEmailJob;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeController extends Controller
{
    public function sedEmailClient(SendEmailRequest $request)
    {
        try {
            $data = $request->all();
            $message = new Message();
            $message->fill($data);
            $message->save();
            dispatch(new SendEmailJob($data));
            return response()->json([
                'success' => true,
            ], 202);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error al enviar el correo',
                'error' => $e->getMessage(),
                'success' => false,
            ]);
        }
    }

    public function getHomeAllEvents()
    {
        try {
            $events = Event::select('id', 'title')->where('status', true)->get();
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

    public function getHomeOnlineEvents()
    {
        try {
            $events = Event::select('title', 'description', 'start_date', 'end_date', 'place', 'address', 'city', 'image', 'status','type')
                ->where('type', 'en-linea')->where('status', true)->get();

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

    public function getHomeInPersonEvents()
    {
        try {
            $events = Event::select('title', 'description', 'start_date', 'end_date', 'place', 'address', 'city', 'image', 'status','type')
                ->where('type', 'presencial')->where('status', true)->get();

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

    public function getHomeCompany()
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
    public function getHomeMembers()
    {
        try {
            $members = Team::select('name', 'last_name', 'second_last_name', 'email', 'phone_number', 'instagram_link', 'facebook_link', 'intro', 'occupation')
                ->limit(6)->get();

            return response()->json([
                'members' => $members,
                'success' => true,
            ], 202);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Éxito al obtener los registros',
                'success' => false,
            ]);
        }
    }
}
