<?php

function check_logged_in() {
    BaseController::check_logged_in();
}
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

$routes->post('/logout', function(){
    CustomerController::logout();
});

//note

$routes->get('/', function(){
    NoteController::index();
});

$routes->get('/note/new', 'check_logged_in', function(){
    NoteController::create();
});

$routes->post('/note/:id/destroy', 'check_logged_in',  function($id){
    NoteController::destroy($id);
});

$routes->get('/note', 'check_logged_in', function(){
    NoteController::index();
});

$routes->get('/note/:id', 'check_logged_in', function($id){
    NoteController::show($id);
});

$routes->post('/note', 'check_logged_in', function(){
    NoteController::store();
});

$routes->get('/note/:id/edit', 'check_logged_in', function($id){
    NoteController::edit($id);
});

$routes->post('/note/:id/edit', 'check_logged_in', function($id){
    NoteController::update($id);
});

//classification


$routes->get('/classification/new', 'check_logged_in', function(){
    ClassificationController::create();
});

$routes->post('/classification/:id/destroy', 'check_logged_in', function($id){
    ClassificationController::destroy($id);
});

$routes->get('/classification', 'check_logged_in', function(){
    ClassificationController::classification();
});

$routes->get('/classification/:id', 'check_logged_in', function($id){
    ClassificationController::show($id);
});

$routes->post('/classification', 'check_logged_in', function(){
    ClassificationController::store();
});

$routes->get('/classification/:id/edit', 'check_logged_in', function($id){
    ClassificationController::edit($id);
});

$routes->post('/classification/:id/edit', 'check_logged_in', function($id){
    ClassificationController::update($id);
});





