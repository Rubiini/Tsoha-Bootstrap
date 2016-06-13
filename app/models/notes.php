<?php

/**
 * Description of notes
 *
 * @author samukaup
 */
class Notes extends BaseModel {

    public $id, $title, $date_, $time_, $place, $status, $priority, $note, $customer;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_date', 'validate_time', 'validate_title', 'validate_place', 'validate_status', 'validate_priority', 'validate_note');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM notes');
        $query->execute();
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
        $query = DB::connection()->prepare('insert into notes (title, date_, time_, place, status, priority, note) values (:title, :date_, :time_, :place, :status, :priority, :note) returning id');
        $query->execute(array(
            'title' => $this->title, 
            'date_' => $this->date_, 
            'time_' => $this->time_, 
            'place' => $this->place, 
            'status' => $this->status, 
            'priority' => $this->priority, 
            'note' => $this->note
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Notes SET title = :title, date_ = :date_, time_ = :time_, place = :place, status = :status, priority = :priority, note = :note WHERE id = :id');
        $query->execute(array(
            'id' => $this->id, 
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
        $query = DB::connection()->prepare('DELETE FROM Notes WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_date() {
        $errors = $this->valid_date($this->date_);
        return $errors;
    }

    public function validate_time() {
        $errors = $this->valid_time($this->time_);
        return $errors;
    }

    public function validate_title() {
        $errors = $this->validate_string_length($this->title, 'title', 2, 80);
        return $errors;
    }

    public function validate_place() {
        $errors = $this->validate_string_length($this->place, 'place', 0, 50);
        return $errors;
    }

    public function validate_status() {
        $errors = $this->validate_string_length($this->status, 'status', 0, 20);
        return $errors;
    }

    public function validate_priority() {
        $errors = $this->validate_string_length($this->priority, 'priority', 0, 30);
        return $errors;
    }

    public function validate_note() {
        $errors = $this->validate_string_length($this->note, 'note', 0, 500);
        return $errors;
    }

}
