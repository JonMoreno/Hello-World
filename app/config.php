<?php

  return 
  
        [
            
         /*
        |--------------------------------------------------------------------------
        | Routes file:
        |--------------------------------------------------------------------------
        | Specify location of the file.
        | All registered routes can abe found in this file    
        */  
            'routes' => 'routes.php',
            
            
        /*
        |--------------------------------------------------------------------------
        | Database: 
        |--------------------------------------------------------------------------
        |
        | Mysql credentials are listed here. This can be extended to use
        | with other types of databases.       
        */ 
            'databases' => [
                
                'mysql' =>[
                    
                'dbname'    => 'NOT DISCLOUSED',
                'username'  => 'NOT DISCLOUSED',
                'password'  => 'NOT DISCLOUSED',
                'connection'=> 'NOT DISCLOUSED',
                'options'   => [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                    ]
                ]
                
            ],


        /*
        |--------------------------------------------------------------------------
        | Amazon:
        |--------------------------------------------------------------------------
        | These are the required credentials to communicate with amazon's api.
        | Any other parameters may be passed to the corresponding class.
        |      
        */     
            'amazon_api' => [

                    'Service'          =>  'NOT DISCLOUSED',
                    'AWSAccessKeyId'   =>  'NOT DISCLOUSED',
                    'AssociateTag'     =>  'NOT DISCLOUSED',
                    'Timestamp'        =>   gmdate('Y-m-d\TH:i:s\Z')
            ]


        ];
  
  
  
  

  
  
  
