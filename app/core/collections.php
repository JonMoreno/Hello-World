<?php
  
namespace App\Model;
  
use App\Core\Container ;
 

/*
|-------------------------------------------------------------------------------
| App Dependency Collections:
|-------------------------------------------------------------------------------
| This file list a collection of dependencies need by the application.
| Additional dependencies can be binded here. When a new dependency 
| is recorded use appropiate Class name, namespaced
| ->>follow convention.
|
------------------
| Index: A --> Z |
------------------
|
|
*/ 


// Amazon
//---------------------------------------------
Container::bind('App\Model\Amazon' , function () 
{
    
    $conf = Container::collect('config');
    
    return 
        new Amazon(
            $conf['amazon_api']
            );
    
}); 

// User:
//---------------------------------------------
Container::bind('App\Model\User' , function ()
{
    return 
        new User(
            
            Container::collect('App\Core\Sessions'),
            Container::collect('App\Core\QueryBuilder') 
            
            );
    
});
























