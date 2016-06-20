<?php

//suunnitelma

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

$routes->get('/suunnitelmat/login', function() {
    HelloWorldController::login();
});

// login 

$routes->get('/login', function() {
    CustomerController::login();
});

$routes->post('/login', function() {
    CustomerController::handle_login();
});

//note

$routes->get('/', function(){
    NoteController::index();
});

$routes->get('/note/new', function(){
    NoteController::create();
});

$routes->post('/note/:id/destroy', function($id){
    NoteController::destroy($id);
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

$routes->get('/note/:id/edit', function($id){
    NoteController::edit($id);
});

$routes->post('/note/:id/edit', function($id){
    NoteController::update($id);
});






