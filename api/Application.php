<?php
namespace app\api;

use app\api\router\Router;
use app\api\request\Request;
use app\api\response\Response;
use app\api\Controller;

class Application{
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public static Application $app;
    public static string $root;
    public function __construct($rootpath){
        self::$app = $this;
        self::$root = $rootpath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }
    public function run(){
        echo $this->router->resolver(); 
    }
    
}