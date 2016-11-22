<?php

namespace App\Core;

use \ReflectionClass;


class Schema
{ 
/*
|-------------------------------------------------------------------------------
| Class Schema                                                            
|-------------------------------------------------------------------------------
| Purpose:
| This class can be very helpful when objects need to be injected with
| certain dependencies, PHP's ReflectionClass makes this possible. It 
| also checks for its dependecies and it will inject them if a
| Container or IoC like class exists.
|            
|
*/
   
    
    public $name;
    
    public $class;
    
    public $dependencies = [ ];
    
    public $_IoC = [
        'class' => '\App\Core\Container',
        'method' => 'collect',
    ];
       
    
    /**
    * Check class existence while storing 
    * instatiated new 
    * 
    * @param type $name string
    * @throws Exception
    */
    public function __construct($name)
    {
        
        if( !class_exists($name) )
        {
            throw new Exception(
                "Class: {$name } does not exist in this application"
                );
        }
        $this->name = $name;
        
        $this->class = new ReflectionClass($name);
        
    }
    
    
    /**
    * Documents and extracs what arguments class's constructor
    * needs to have before being called and returns 
    * them as an array.
    * 
    * @return type array
    */
    public function mapConstructor()
    {
            
        $constructor = $this->class->getConstructor();
        
        $dependencies = [];
        
        if(!is_null($constructor))
        {
            $args = $constructor->getParameters();
            
            foreach($args as $arg)
            {
                array_push(
                        $dependencies, $arg->getClass()->getName()
                    );
            } 
        }
            
        return $dependencies;
        
    }
    
    
    /**
    * Gathers all the arguments the constructor needs via
    * the ->mapConstructor(), once info is gather it
    * summons the appropriate object.
    *
    * @param type $methodName string
    * @return type object 
    */
    public function callConstructor()
    {
 
        $args = $this->mapConstructor();
       
        if( empty($args) )
        {    
            
            return 
                $this->class->newInstance();
                
        }
        else
        {
            return 
                 $this->class->newInstanceArgs($this->batchDependencies($args));
        }  
    }
    
    
    /**
    * Documents and extracs what arguments the method
    * needs to have before being called and returns 
    * them as an array.
    *
    * @param type $name string
    * @return array
    */
    public function mapMethod($name)
    {
        
        $args = $this->class->getMethod($name)->getParameters();

        $dependencies = [];
        
        foreach($args as $arg)
        {
            array_push(
                    $dependencies, $arg->getClass()->getName()
                );
        } 
            
        return $dependencies;
        
    } 
    
    
    /**
    * Gathers all the arguments the methods needs via
    * the ->mapMethod(), once info is gather it
    * summons the appropriate method.
    *
    * @param type $methodName string
    * @return type object method
    */
    public function callMethod($methodName)
    {       
        
        $args = $this->mapMethod($methodName);

        if( empty($args) )
        {   
           return 
                call_user_func( 
                    array( $this->callConstructor() , $methodName )
                    );
           
        }
        else 
        {
            return
                call_user_func_array(
                    array( $this->callConstructor() , $methodName) 
                    , $this->batchDependencies($args)
                    );
            
        }
            
    }
    
 
    /**
    * Summons all the necessary dependencies the class _construct
    * or method needs. 
    *
    * Works in correlation witn a Ioc like class, collecting
    * necessary dependecies via one the classe's method.
    *
    * @param type $dependecies array
    * @return array object array.
    */
    public function batchDependencies($dependecies)
    {
        
        $objCollection = [];
        
        foreach($dependecies as $collect)
        {
            array_push(
               $objCollection ,
                    call_user_func_array(
                        array(
                            $this->_IoC['class'], $this->_IoC['method'] 
                        ) ,
                        array(
                            $collect 
                        )
                    )
                );
        }
        
        return $objCollection;
        
    }
    
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
    
    
    
    
    
    
    
    