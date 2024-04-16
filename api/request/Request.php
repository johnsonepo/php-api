<?php
namespace app\api\request;
class Request  {
    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }
    public function method() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function isGet() {
        if($this->method() === 'get') {  
            return true;
        }
        return false;
    }
    public function isPost() {  
        if($this->method() === 'post') {
            return true;
        }
        return false;
    }
    public function input() {  
        $body = [];
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return (object)$body;
    }
}