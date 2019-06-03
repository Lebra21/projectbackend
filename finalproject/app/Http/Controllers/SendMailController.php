<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Session;
class SendMailController extends Controller
{
    public function contacts(){
    	return view('front.contacts');
    }
    
    public function send(Request $get){
    	$this->validate($get,[
    		"email" => "required",
    		"message" => "required"
    	]);
    	$email = $get->email;
    	$message = $get->message;
    	

    	Mail::to($email)->send(new SendMail($message));
    	Session::flash("success");
    	return back();
    }
}
