<?php
/*
|-------------------------------------------------------------------------------
|
|-----------------------[ APPLICATION ENTRY POINT ]-----------------------------         
|             
|-------------------------------------------------------------------------------
*/
  
use App\Core\Http;
use App\Core\Router;
use App\Core\Container as App;

  
/**
* All Appliaction files are stored
* eith in this file.
*/
require 'bootstrap.php';


/**
* Initialize Router to filter all defined 
* routes as well as listening to the
* servers request method and uri.
*
*/

//--------------
// ROUTES FILE:
//--------------
$file = App::collect('config')['routes']; 


//--------------
// ROUTER INIT:
//--------------

// --> Router Initializes <---    RequestUri        RequestMethod   
Router::load($file)->direct( (new Http)->uri(),(new Http)->method() );




