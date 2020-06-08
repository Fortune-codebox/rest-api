<?php

namespace App\Helper\Functions;

use App\Response\Response;
use App\Service\ApiHandler;

trait ApiReturnResponse {

   protected function apiResponse($status, $message, $data, $status_code = 0){
        if(!isset($message) || !isset($data) || !isset($status)){
            throw new Exception('response attributes missing', 500);
        }
        if($status_code != 0)
            $res = new Response($message, $status, $data, $status_code);
        else
            $res = new Response($message, $status, $data);
       return $res->send();
    }
    
    protected function getErrorMessages(\Illuminate\Contracts\Validation\Validator $validator){
        $messages =  $validator->errors()->getMessages();
        $replaced = str_replace(['[',']', '"', '.','id'], '', json_encode(array_values($messages)));
        return explode(',',$replaced);
    }

}
