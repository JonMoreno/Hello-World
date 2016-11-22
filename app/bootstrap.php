<?php

namespace App\Core;

use App\Core\Container as App;

/*
|--------------------------------------------------------------------------
| Bootstrap: 
|--------------------------------------------------------------------------
| All the necessary scripts are loaded here.
| 
*/ 

    /**
    * Composer PSR-4 autoloading file must be included
    * at an entry poiny to load all necessary class   
    * files for current application needs.   
    * 
    */
    require '../vendor/autoload.php';


    /*
    |---------------------------------------------------------------------------
    | Collections:
    |---------------------------------------------------------------------------
    | Other Collections: --> app/core/collections.php <--
    |
    */
    
    
    // Config File:
    //---------------------------------------------
    App::bind('config', function () 
    {
        
        return
            require 'config.php';

    });
    
    // Request:
    //---------------------------------------------
    App::bind('App\Core\Request', function ()
    {

       return  new Request();

    });


    // Sessions:
    //---------------------------------------------
    App::bind('App\Core\Sessions', function ()
    {
        return new Sessions();

    });


    // Connection 
    //---------------------------------------------
    App::bind('App\Core\Connection', function () 
    {

        $config = App::collect('config');

        $mysql = $config['databases']['mysql'];

        return 
            (new Connection($mysql))->make();
        

    });


    // QueryBuilder 
    //---------------------------------------------
    App::bind('App\Core\QueryBuilder', function ()
    {

        $connection = App::collect('App\Core\Connection');

        return 
            new QueryBuilder( $connection );

    });
    
    
    