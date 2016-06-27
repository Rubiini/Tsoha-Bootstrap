<?php

/**
 * Description of notes
 *
 * @author samukaup
 */
class Notes extends BaseModel {

    public $validators;
    public $id, $title, $date_, $time_, $place, $status, $priority, $note, $customer;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array(
            'validate_date',
            'validate_time',
            'validate_title', 
            'validate_place', 
            'validate_status', 
            'validate_priority', 
            'validate_note');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM notes where customer = :customer');
        $query->execute(array('customer' => $_SESSION['user']));
        $rows = $query->fetchAll();
        $notes = array();

        foreach ($rows as $row) {
            $notes[] = new Notes(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'date_' => $row['date_'],
                'time_' => $row['time_'],
                'place' => $row['place'],
                'status' => $row['status'],
                'priority' => $row['priority'],
                'note' => $row['note'],
                'customer' => $row['customer']
            ));
        }
        return $notes;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Notes WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $notes = new Notes(array(
                'id' => $row['id'],
                'title' => $row['title'],
                'date_' => $row['date_'],
                'time_' => $row['time_'],
                'place' => $row['place'],
                'status' => $row['status'],
                'priority' => $row['priority'],
                'note' => $row['note'],
                'customer' => $row['customer']
            ));

            return $notes;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('insert into notes (title, date_, time_, place, status, priority, note, customer) values (:title, :date_, :time_, :place, :status, :priority, :note, :customer) returning id');
        $query->execute(array(
            'title' => $this->title, 
            'date_' => $this->date_, 
            'time_' => $this->time_, 
            'place' => $this->place, 
            'status' => $this->status, 
            'priority' => $this->priority, 
            'note' => $this->note,
            'customer' => BaseController::get_user_logged_in()->id
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE notes SET title = :title, date_ = :date_, time_ = :time_, place = :place, status = :status, priority = :priority, note = :note WHERE id = :id');
        $query->execute(array(
            'id' => (Int)$this->id, 
            'title' => $this->title, 
            'date_' => $this->date_, 
            'time_' => $this->time_, 
            'place' => $this->place, 
            'status' => $this->status, 
            'priority' => $this->priority, 
            'note' => $this->note
                
        ));
    }

    public function destroy() {
        $classQuery = DB::connection()->prepare('DELETE FROM classifications WHERE notes = :notes');
	$classQuery->execute(array('notes' => $this->id));
        
        $query = DB::connection()->prepare('DELETE FROM notes WHERE id = :id');
        $query->execute(array('id' => $this->id));
        
    }

    public function validate_date() {
        return parent::valid_date($this->date_);
    }

    public function validate_time() {
        return parent::valid_time($this->time_);
    }

    public function validate_title() {
        return parent::validate_string_length($this->title, 'title', 2, 80);
    }

    public function validate_place() {
        return parent::validate_string_length($this->place, 'place', 0, 50);
    }

    public function validate_status() {
        return parent::validate_string_length($this->status, 'status', 0, 20);
    }

    public function validate_priority() {
        return parent::validate_string_length($this->priority, 'priority', 0, 30);
    }

    public function validate_note() {
        return parent::validate_string_length($this->note, 'note', 0, 500);
    }

}
