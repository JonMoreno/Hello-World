<?php

namespace App\Core;  
  
 
class Connection 
{
/*
|-------------------------------------------------------------------------------
| Class Connection:
|-------------------------------------------------------------------------------
| Purpose:
| Helps accessing mysql database managed via PDO Interface.
| Class can be extended for alternate databases.
| 
|       
*/
    
    protected $config;

    
    /**
    * Set DB Configuration information.
    * 
    * @param $config array
    */
    public function __construct($config)
    {
        $this->config = $config;
    }
    
    
    /**
    * Create Mysql connection.
    * 
    * @return PDO instance.
    */
    public function make()
    {     
        $config = $this->config;
        try
        {
            return new \PDO(
                $config['connection'].';dbname='.$config['dbname'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } 
        catch (Exception $ex) 
        {
            die($ex->getMessage());
        }
        
    }
    
    
}
  