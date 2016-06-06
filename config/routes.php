<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/classifications', function() {
    HelloWorldController::classifications();
});

$routes->get('/classification/show', function() {
    HelloWorldController::classification_show();
});

$routes->get('/classification/edit', function() {
    HelloWorldController::classification_edit();
});

$routes->get('/notes', function() {
    HelloWorldController::notes();
});

$routes->get('/note/show', function() {
    HelloWorldController::note_show();
});

$routes->get('/note/edit', function() {
    HelloWorldController::note_edit();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/', function(){
    NoteController::index();
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

$routes->get('/note/new', function(){
  NoteController::create();
});


