<?php

/**
 * Description of Notes
 *
 * @author samukaup
 */
class Notes extends BaseModel {

    public $id, $title, $date_, $time_, $place, $status, $priority, $note, $customer;

    public function __construct($attributes) {
        parent::__construct($attributes);
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
        
        if($row){
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
	  $query = DB::connection()->prepare('insert into notes (title, date_, time_, place, status, priority, note) values (:title, :date_, :time_, :place, :status, :priority, :note returning id');
	  $query>execute(array('title' => $this->title, 'date_' => $this->date_, 'time_' => $this->time_, 'place' => $this->place, 'status' => $this->status, 'priority' => $this->priority, 'note' => $this->note,));
	  $row = $query->fetch();
	  $this->id = $row['id'];
	}
}   
    