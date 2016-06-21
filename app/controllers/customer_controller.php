<?php


class CustomerController extends BaseController{
    
  public static function login(){
      View::make('customer/login.html');
  }
  
  public static function handle_login(){
    $params = $_POST;

    $customer = Customer::authenticate($params['username'], $params['password']);

    if(!$customer){
      View::make('customer/login.html', array('error' => 'Incorrect username or password!', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $customer->id;

      Redirect::to('/', array('message' => 'Welcome back ' . $customer->username . '!'));
    }
  }
  public static function logout() {
      $_SESSION['user'] = null;
      Redirect::to('/login', array('message' => 'You have logged out successfully!'));
  }
}