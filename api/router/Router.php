<?php 
namespace app\api\router;

use app\api\Application;
use app\api\request\Request;
use app\api\response\Response;

class Router{
    public $request;
    public $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response) {
        $this->request =  $request;
        $this->response = $response;
    }
    public function get($end_point, $callback) {
        $this->routes['get'][$end_point] = $callback;
    }
    public function post($end_point, $callback) {
        $this->routes['post'][$end_point] = $callback;   
    }
    public function resolver() {
        $end_point = $this->request->getPath();
        $action = $this->request->method();
        
        $callback = $this->routes[$action][$end_point] ?? false;

        if ($callback === false) {
            $this->response->setRespnseStatus(404);
            return '404';
        }

        if(is_string($callback)) {
            // to handle case of string
        }
        if(is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }
}