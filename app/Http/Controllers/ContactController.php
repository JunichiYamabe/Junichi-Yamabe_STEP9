<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
   public function contact()
   {
       return view('emails.contact');
   }

   public function send(ContactRequest $request)
   {
    $data = $request->validated();
    try{
        //管理者にメールを送信
        Mail::to(config('mail.admin_email'))->send(new ContactMail($data));
    }catch(\Exception $e){
        //送信失敗時のエラーハンドリング
        \Log::error('メール送信エラー: ' . $e->getMessage());
        return redirect()->route('contact')->with('error', 'メール送信中にエラーが発生しました。後でもう一度お試しください。');
    }
    //送信成功時のリダイレクト
    return redirect()->route('contact')->with('success', 'お問い合わせ内容を送信しました。');
   }
}