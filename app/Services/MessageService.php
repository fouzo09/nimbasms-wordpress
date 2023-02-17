<?php
namespace App\Services;

use App\Helpers\CustomRequest;
use App\Models\Message;

class MessageService{

    public static function send(Message $newMessage){
        $body = [
            "to" => $newMessage->to,
            "sender_name" => $newMessage->sender_name,
            "message" => $newMessage->message
        ];

        $response = CustomRequest::send_post('/messages', $body);

        dd($response);

    }

}