<?php

if(! function_exists('save_to_a_file')){
    function save_to_a_file($fileLink, $fileContent, $mode){
        if(!$fileLink || ! $fileContent) return;
        $openedFile = fopen($fileLink, $mode) or die("Impossible d'ouvrir  le fichier!");
        $result = fwrite($openedFile, $fileContent);
        fclose($openedFile);
    }
}


if(! function_exists('get_file_content')){
    function get_file_content($fileLink){
        if(!$fileLink || !file_exists($fileLink)) return;
        $openedFile = fopen($fileLink, 'r') or die("Impossible d'ouvrir  le fichier!");
        $result = fread($openedFile, filesize($fileLink));
        fclose($openedFile);

        return $result;
    }
}

if(! function_exists('dd')){
    function dd($message){
        var_dump($message); die();
    }
}
