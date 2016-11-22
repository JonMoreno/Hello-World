<?php

namespace App\Core;  
  
  
class Sessions
{
    
/*
|--------------------------------------------------------------------------
| Class Session
|--------------------------------------------------------------------------
| Purpose:
| A very native way to manage PHP's sessions. 
|  
*/ 
    
   public $sessions = [ ];
    
    
   /**
   * As soon as Session Object is created is will
   * check for any ocurring sessions, otherswise
   * a new session will start.
   */
   public function __construct()
   {
       if( !isset($_SESSION) )
       {
           session_start();
       }
   }
   
   
   /**
   * Start a new session
   *
   * @throws Exception
   */
   public function start()
   {
       session_destroy();
       
       if( !session_start() )
       {
         throw new Exception(
                "Unable to Generate a new session"
                );
       }
   }
   
   
   /**
   * Destroy session at play.
   *
   * @throws Exception
   */
   public function destroy()
   {
       if( !session_destroy() )
       {
           throw new Exception(
                "Unabler to Destroy session in play"
               );
       }
   }
   
  
   /**
   * Generate a new sessiond id. If a
   * custom id is needed pass as an
   * 
   * @param type $id string
   */
   public function generateId( $id = null)
   {
       if( is_null($id) )
       {
           session_regenerate_id();
       }
       else
       {
           session_id($id);
       }
   }
   
   
   /**
   *  Return currest session id.
   * @return type string
   */
   public function retrieveId()
   {
       
       return session_id();
       
   }
   
   
   /**
   * Assing a key value session.
   * 
   * @param type $key string
   * @param type $val string
   */
   public function put($key , $val)
   {
       $_SESSION[$key] = $val;
   }
   
   
   /**
   * Verify existense of session with a key.
   * 
   * @param type $key
   * @throws Exception
   * @return boolean
   */
   public function has($key)
   {
       if( isset($_SESSION) )
       {
            return 
                array_key_exists($key, $_SESSION);
       }
       else
       {
           return false;
       }
   }
   
  
   /**
   * Retrive all current sessions.
   * 
   * @return type array.
   * @throws Exception
   */
   public function all()
   {
       if( !isset($_SESSION) )
       {
           throw new Exception(
               "A SESSION has not been establishe"
               );
       }
       else
       {
           return $_SESSION;
       }
    
   }
   
   
   
   
   
   
    
       
}
  