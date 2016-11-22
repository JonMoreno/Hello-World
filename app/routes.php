<?php
/*
|-------------------------------------------------------------------------------
| Application Routes File.
|-------------------------------------------------------------------------------
| Register desired routes in this file.
| @param 1 Registered Uri 
| @param 2 Assign a Conroller->action
|
|
*/


//-------------------------------------------------

// VIEWS:
  
 $router->post('app/login'  ,  'UsersController->logIn');
 
 $router->get( 'app/home/'  ,  'UsersController->home' );
 
 $router->get( 'app/logout/',  'UsersController->logOut');
 
 //Testing Route
 $router->get( 'app/lab/',  'DataController->lab');
   
//-------------------------------------------------

// DATA:.
 
 $router->get( 'app/records/',  'DataController->show' );
 

 $router->post( 'app/aws/'   ,  'DataController->fetch' );
 

 $router->post( 'app/store/' ,  'DataController->store' );
 
 
 $router->post( 'app/delete/',  'DataController->destroy');
 

 
