<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderShippedEmail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order' => 'required',
            'fromAddress' => 'required|email',
            'toAddress' => 'required|email',
            'subject' => 'required|string',
            'contentBody' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $order = $request->input('order');
        $fromAddress = $request->input('fromAddress');
        $toAddress = $request->input('toAddress');
        $subject = $request->input('subject');
        $contentBody = $request->input('contentBody');

        try {
            SendOrderShippedEmail::dispatch($order, $fromAddress, $toAddress, $subject, $contentBody);
            return response()->json(['message' => 'Email sent successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
