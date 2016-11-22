<?php
  
namespace App\Core;
 
use \Closure;
  
 
class Container 
{
/*
|-------------------------------------------------------------------------------
| Class Container -> Inverse of Control                                                             
|-------------------------------------------------------------------------------
| Purpose: 
| Management of dependencies. They can be registered and collected. 
| Can also be used to store other important information needed by 
| the application
|
| To register a collection of dependencies look into: 
|      --> app/core/collections.php <--
|
|
*/
    
    public static $dependency = [ ];
    
    
    /**
    * Bind a dependecy as key value pair. The class name
    * 'properly namespaced' will act as a key and the
    *  anonymous function as value returned
    *
    * @param type $class string
    * @param Closure $resolve 
    */
    public static function bind($class , Closure $resolve)
    {
       
        self::$dependency[$class] = $resolve;
        
    }
    
    
    /**
    * Collect with KEY, from $dependency array   
    * property the desired Object/Dependency.
    * 
    * @param type $class string
    * @return type Object
    * @throws \Exception
    */
    public static function collect($class)
    {
        
        if(self::verify($class)) {
           
            $object = self::$dependency[$class];
           
            return $object();
        } 
        
        throw new \Exception(
            "This Dependency does not exist. Register dependency {$class}"
            );

    }
    
    
    /**
    * Check existence of the KEY being called.
    *
    * @param type $class
    * @return type
    */
    public static function verify($class)
    {
        return 
            array_key_exists($class, self::$dependency);
    }
    
    
}
  