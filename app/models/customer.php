<?php

class Customer extends BaseModel {

    public $id, $username, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if ($row) {
            $customer = new Customer(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
        }
        
        return $customer;
    }
    
    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('select * from customer where username = :username and password = :password limit 1');
        $query->execute(array(
            'username' => $username,
            'password' => $password
        ));
        
        $row = $query->fetch();
        
        if ($row) {
            return new Customer(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
        } else {
            return null;
        }
    }
    
    public static function create_new_customer($username, $password) {
        $query = DB::connection()->prepare('select * from customer where username = :username');
        $query->execute(array('username' => $username));
        $row = $query->fetch();
        
        $errors = array();
        if ($row) {
            $errors[] = "Username already exists";
        }
        
        
        
    }
}
