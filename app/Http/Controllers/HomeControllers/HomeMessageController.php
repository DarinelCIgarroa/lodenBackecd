<?php

namespace App\Http\Controllers\HomeControllers;

use Exception;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;

class HomeMessageController extends Controller
{
    public function sedEmailClient(Request $request)
    {
        try {
            $validated = $request->validate([
                'mail' => 'required|email',
                'phone_number'=>'required|numeric',
                'full_name'=>'required|string',
                'message'=>'required|min:20|max:150|string'
            ]);

            $data = $request->all();
            $message = new Message();
            $message->fill($data);
            $message->save();
            dispatch(new SendEmailJob($data));
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al enviar el correo',
                'success' => false,
            ]);
        }
    }
}
