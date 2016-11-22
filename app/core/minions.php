<?php
  
/*
|-------------------------------------------------------------------------------
| Functions:
|-------------------------------------------------------------------------------
| Purpose:
| These functions are available throughout the application. 
| Helps with minor repetitive scripts.
|   
*/
  
  
/**
* Helps passing views to controllers.
*
* @param type $page string
* @param type $data array.
* @return type
*/
function view($page , $data = []){
    
    extract($data);
    
    return 
        require "views/{$page}";
    
}

/**
* 
*
* @param type $location string
*/
function redirect($location = null)
{
 
    if(is_null($location))
    {
        header('Location: http://localhost:8888/');
    }
    else{
        header("Location: {$location} ");
    }
    
}


/**
* Faster way to var_dump variables.
* @param type $data All
*/
function dump($data){
  
    var_dump($data);
    exit();
        
}


   
