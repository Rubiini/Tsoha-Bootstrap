<?php

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['user'])) {
            $customer_id = $_SESSION['user'];
            $customer = Customer::find($customer_id);

            return $customer;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['user'])) {
            Redirect::to('/login', array('message' => 'Login first!'));
        }
    }

}
