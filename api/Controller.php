<?php 
namespace app\api;
class Controller{
    public function render_response($params = []){
        return json_encode($params);       
    }
}