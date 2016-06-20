<?php


class CustomerController extends BaseController{
  public static function login(){
      View::make('customer/login.html');
  }
  public static function handle_login(){
    $params = $_POST;

    $user = Customer::authenticate($params['username'], $params['password']);

    if(!$user){
      View::make('customer/login.html', array('error' => 'Incorrect username or password!', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Welcome back ' . $user->name . '!'));
    }
  }
}