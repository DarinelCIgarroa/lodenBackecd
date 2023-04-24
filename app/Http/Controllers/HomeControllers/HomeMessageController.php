<?php

namespace App\Http\Controllers\HomeControllers;

use Exception;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeMessageController extends Controller
{
    public function sedEmailClient(Request $request)
    {
        try {
            $data = $request->all();

            dispatch(new SendEmailJob($data));

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error al enviar el correo',
                'success' => false,
            ]);
        }
    }
}
