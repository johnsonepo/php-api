<?php

include_once __DIR__ .'/../vendor/autoload.php';

use app\api\Application;
use app\api\controller\CustomerController;

$app = new Application(dirname(__DIR__));
$app->router->get("/customers", [CustomerController::class,'index']);


$app->run();