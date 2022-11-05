<?php

function sendMail($template, $to , $subject, $data){
    \Illuminate\Support\Facades\Mail::send($template,$data,function($message) use ($to , $subject){
        $message-> from('mahmoud.hussiba@outlook.com');
        $message -> subject($subject);
        $message -> to($to);
    });
}

