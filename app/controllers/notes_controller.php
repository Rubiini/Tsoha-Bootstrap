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
        $notes = Notes::find($id);
        View::make('notes/show.html', array('notes' => $notes));
    }

    public static function store() {
        $params = $_POST;
        $attributes = new Notes(array('title' => $params['title'],
            'date_' => $params['date_'],
            'time_' => $params['time_'],
            'place' => $params['place'],
            'status' => $params['status'],
            'priority' => $params['priority'],
            'note' => $params['note']
        ));

        $note = new Notes($attributes);
        $errors = $note->errors();

        
        if (count($errors == 0)) {
            $note->save();
            Redirect::to('/note/' . $note->id, array('message' => 'Note has been added to your notebook!'));
        } else {
            View::make('notes/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function create() {
        View::make('notes/new.html');
    }

    public static function edit($id) {
        $note = Notes::find($id);
        View::make('notes/edit.html', array('attributes' => $note));
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Notes (title, date_, time_, place, status, priority, classification, note) VALUES (:title, :date_, :time_, :place, :status, :priority, :classification, :note) RETURNING id');
        $query->execute(array('title' => $this->title, 'date_' => $this->date_, 'time_' => $this->time_, 'place' => $this->place, 'status' => $this->status, 'priority' => $this->priority, 'classification' => $this->classification, 'note' => $this->note));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'title' => $params['title'],
            'date_' => $params['date_'],
            'time_' => $params['time_'],
            'place' => $params['place'],
            'status' => $params['status'],
            'priority' => $params['priority'],
            'note' => $params['note']
        );

        $note = new Notes($attributes);
        $errors = $note->errors();

        if (count($errors) > 0) {
            View::make('notes/:id/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $note->update();

            Redirect::to('/notes/' . $note->id, array('message' => 'Note has been edited successfully!'));
        }
    }

    public static function destroy($id) {
        $note = new Notes(array('id' => $id));
        $note->destroy();

        Redirect::to('/notes', array('message' => 'Note has been deleted successfully!'));
    }
}
