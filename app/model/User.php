<?php
  
namespace App\Model;

use \App\Core\QueryBuilder;
use \App\Core\Sessions;

class User
{
/*
|-------------------------------------------------------------------------------
| Class User
|-------------------------------------------------------------------------------
| Purpose:
| Creates variousmet
| 
|       
*/ 
    
    public $database;
    
    public $session;


    public function __construct(Sessions $session, QueryBuilder $database)
    {
        
        $this->session = $session;
        $this->database = $database;
    }
    
    
    /**
    * Validate User logIn credentials.
    * 
    * @param type $values
    * @return type boolean
    */
    public function isUser($values)
    {
        
        return 
            $this->database->validator('users', $values);
        
    }
    
    
    /**
    * Start a new User Session.
    *
    * @param type $key string
    */
    public function initSession($key )
    {
        $this->session->put($key , 'start');
        
    }
    
    public function viewSession()
    {
        return $this->session->all();
    }
    
    /**
    * Check for session variable;
    * 
    * @param type $key
    * @return type boolean
    */
    public function auth($key)
    {
      
        return $this->session->has($key); 
        
    }
    
    
    /**
    * Destroy User session.
    */
    public function endLog()
    {
        $this->session->destroy();
    }
    
    
        
}