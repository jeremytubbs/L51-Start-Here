<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    /**
     * Display a contact page.
     *
     * @return Response
     */
    public function getContact()
    {
        return view('pages.contact');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function postContact(ContactRequest $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'the_message' => $request->get('message')
        ];

        \Mail::queue('emails.contact', $data, function($message)
        {
            $message->to(env('MAIL_ADDRESS'), env('MAIL_NAME'))->subject('Contact Form');
        });
        return redirect()->back();
    }
}
