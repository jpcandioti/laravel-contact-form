<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Message;
use App\Mail\MessageSended;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a Contact Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact', ['subjects' => Subject::all()]);
    }

    public function submit(Request $request)
    {
        $success = false;
        $errors  = null;
        
        $validator = Validator::make(request()->all(), [
            recaptchaFieldName() => recaptchaRuleName()
        ]);

        // check if validator fails.
        if ($validator->fails()) {
            $errors = $validator->errors();
        }else {
            $message = new Message();
            $message->fromName  = $request->fromName;
            $message->fromEmail = $request->fromEmail;
            $message->toEmail   = env('CONTACT_TO', '');
            $message->subjectId = $request->subjectId;
            $message->body      = $request->body;
            $message->addedOn   = new \DateTime();
            $message->spamAnalizer();
            $success = $message->save();
            
            if ($success && !empty($message->toEmail) && !$message->isSpam()) {
                // Send email.
                Mail::to($message->toEmail)
                    ->send(new MessageSended($message));
            }
        }

        return view('submit', ['success' => $success, 'errors' => $errors]);
    }
}
