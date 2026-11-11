<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact; // ビューに渡す変数

    // コンストラクタでリクエストデータを受け取る
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    // メールの件名や差出人など
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '【お問い合わせ】新しいメッセージが届きました',
        );
    }

    // メールの本文となるBladeビューを指定
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact', // resources/views/emails/contact.blade.php 
        );
    }
}