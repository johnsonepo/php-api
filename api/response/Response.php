<?php 
namespace app\api\response;
class Response{
    public function setRespnseStatus(int $code) {
        http_response_code($code);
    }
}