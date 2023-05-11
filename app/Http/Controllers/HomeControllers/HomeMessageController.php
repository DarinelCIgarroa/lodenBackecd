<?php

namespace App\Http\Controllers\HomeControllers;

use Exception;
use App\Models\Team;
use App\Models\Event;
use App\Models\Company;
use App\Models\Message;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HomeMessageController extends Controller
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
    // public function getEvents()
    // {
    //     try {
    //         $events = Event::select('id', 'name')->where('status', '=', '1')->get();
    //         return response()->json([
    //             'success' => true,
    //             'events' => $events,
    //         ], 202);
    //     } catch (ModelNotFoundException $e) {
    //         return response()->json([
    //             'message' => 'Error al obtener registros',
    //             'success' => false,
    //         ]);
    //     }
    // }
    public function getAllEvents()
    {
        try {
            $events = Event::where('status', '=', '1')->get();
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
