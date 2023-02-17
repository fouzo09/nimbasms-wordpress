<?php
namespace App\Services;

use App\Helpers\CustomRequest;
use App\Models\Message;
use Exception;

class MessageService{

    public static function send(Message $newMessage){
        $body = [
            "to" => $newMessage->to,
            "sender_name" => $newMessage->sender_name,
            "message" => $newMessage->message
        ];

        $response = CustomRequest::send_post('/messages', $body);

        if($response["code"] === 201){

            return "Message envoyé avec succès";
        }elseif($response["code"] === 400){

            $content = json_decode($response["content"]);

            if(isset($content->sender_name)){

                throw new Exception($content->sender_name);
            }elseif(isset($content->solde)){

                throw new Exception($content->solde);
            }elseif(isset($content->to)){

                throw new Exception($content->to);
            }elseif(isset($content->detail)){

                throw new Exception($content->detail);
            }
            
        }elseif($response["code"] === 401){

            throw new Exception($response["content"]["details"]);
        }elseif($response["code"] === 429){

            throw new Exception($response["content"]["details"]);
        }else{

            throw new Exception($response["content"]["details"]);
        }
    }

}