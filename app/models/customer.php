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
}
