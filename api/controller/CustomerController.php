<?php 
namespace app\api\controller;


use app\api\Controller;
use app\api\model\Customer;
use app\api\request\Request;

class CustomerController extends Controller{
    public function index(Request $request){
        if($request->isPost()){
            return "handle post";
        }
        $customer = Customer::getInstance();

        // Get all customers
        $customers_data = $customer->getAll();
        return $this->render_response($customers_data);
    }
}