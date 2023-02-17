<?php
namespace App\Helpers;

use App\Services\ConfigService;

class CustomRequest{

    private static $credentials = '';
    private static $base_url = 'https://api.nimbasms.com/v1';

    public static function send_post($uri, $params) {

        self::$credentials = ConfigService::getCredentials();
        $query = json_encode($params);

        $headers  = array(
            'Content-Type: application/json',
            'Authorization: Basic '.base64_encode(self::$credentials->service_id.':'.self::$credentials->secret_token),
            'Accept: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, self::getFullUrl($uri));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ["code"=> $httpcode, "content"=>$response];
    }


    private static function getFullUrl($uri){
        if(!$uri) return;
        return self::$base_url.''.$uri;
    }
}