<?php

/**
 * Description of notes_controller
 *
 * @author samukaup
 */
class NoteController extends BaseController {

    public static function index() {
        $notes = Notes::all();
        View::make('notes/index.html', array('notes' => $notes));
    }

    public static function show($id) {
        $note = Notes::find($id);
        View::make('notes/show.html', array('note' => $note));
    }

    public static function store() {
        $params = $_POST;
        $note = new Notes(array('title' => $params['title'],
            'date_' => $params['date_'],
            'time_' => $params['time_'],
            'place' => $params['place'],
            'status' => $params['status'],
            'priority' => $params['priority'],
            'note' => $params['note']
        ));

        $note->save();

        Redirect::to('/note/' . $note->id, array('message' => 'Note has been added to your notebook!'));
    }

    public static function create() {
	  View::make('notes/new.html');
    }
        
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Notes (title, date_, time_, place, status, priority, classification, note) VALUES (:title, :date_, :time_, :place, :status, :priority, :classification, :note) RETURNING id');
        $query->execute(array('title' => $this->title, 'date_' => $this->date_, 'time_' => $this->time_, 'place' => $this->place, 'status' => $this->status, 'priority' => $this->priority, 'classification' => $this->classification, 'note' => $this->note));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    

}
