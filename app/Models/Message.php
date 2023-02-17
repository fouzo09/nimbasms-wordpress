<?php
namespace App\Models;

class Message{

    public array $to;
    public string $message;
    public string $sender_name;

    function __construct(array $to, string $message) {
        $this->to = $to;
        $this->message = $message;
        $this->sender_name = "Nimba API";
    }


}