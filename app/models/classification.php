<?php

/**
 * Description of notes
 *
 * @author samukaup
 */
class Classification extends BaseModel {

    public $validators;
    public $id, $title, $customer;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_title');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Classification where customer = :customer');
        $query->execute(array('customer' => $_SESSION['user']));
        $rows = $query->fetchAll();
        $classification = array();

        foreach ($rows as $row) {
            $classification[] = new Notes(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'customer' => $row['customer']
            ));
        }
        return $classification;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Classification WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $classification = new Notes(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'customer' => $row['customer']
            ));

            return $classification;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('insert into classification (title, customer) values (:title, :customer) returning id');
        $query->execute(array(
            'title' => $this->title, 
            'customer' => BaseController::get_user_logged_in()->id
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE classification SET title = :title WHERE id = :id');
        $query->execute(array(
            'id' => $this->id, 
            'title' => $this->title
        ));
    }

    public function destroy() {
        $classQuery = DB::connection()->prepare('DELETE FROM notes WHERE classification = :classification');
	$classQuery->execute(array('classification' => $this->id));
        
        $query = DB::connection()->prepare('DELETE FROM classification WHERE id = :id');
        $query->execute(array('id' => $this->id));
        
    }

    public function validate_title() {
        return parent::validate_string_length($this->title, 'title', 2, 80);
    }

}

