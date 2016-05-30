<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }

    public static function classifications() {
        View::make('suunnitelmat/classifications.html');
    }
    
    public static function classification_show() {
        View::make('suunnitelmat/classification_show.html');
    }
    
    public static function classification_edit() {
        View::make('suunnitelmat/classification_edit.html');
    }
    
    public static function notes() {
        View::make('suunnitelmat/notes.html');
    }

    public static function note_show() {
        View::make('suunnitelmat/note_show.html');
    }
    
    public static function note_edit() {
        View::make('suunnitelmat/note_edit.html');
    }
    
    public static function login() {
        View::make('suunnitelmat/login.html');
    }

}
