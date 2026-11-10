<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
   public function contact()
   {
       return view('contact');
   }

   public function send(Request $request)
   {
       // バリデーション
       $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|max:255',
           'message' => 'required|string',
       ]);

       // メール送信処理（例: Mailファサードを使用）
       Mail::to('yamabe.j@gmail.com')->send(new ContactMail($request->all()));
       return redirect()->route('index')->with('success', 'お問い合わせを送信しました。');
    }
}
