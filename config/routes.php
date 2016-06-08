<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/suunnitelma/classifications', function() {
    HelloWorldController::classifications();
});

$routes->get('/suunnitelma/classification/show', function() {
    HelloWorldController::classification_show();
});

$routes->get('/suunnitelma/classification/edit', function() {
    HelloWorldController::classification_edit();
});

$routes->get('/suunnitelma/notes', function() {
    HelloWorldController::notes();
});

$routes->get('/suunnitelma/note/show', function() {
    HelloWorldController::note_show();
});

$routes->get('/suunnitelma/note/edit', function() {
    HelloWorldController::note_edit();
});

$routes->get('/suunnitelma/login', function() {
    HelloWorldController::login();
});

$routes->get('/', function(){
    NoteController::index();
});

$routes->get('/note/new', function(){
    NoteController::create();
});

$routes->get('/note', function(){
    NoteController::index();
});

$routes->get('/note/:id', function($id){
    NoteController::show($id);
});

$routes->post('/note', function(){
    NoteController::store();
});




