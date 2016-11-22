<?php

namespace App\Core;
  
  
class Request extends Http
{
/*
|--------------------------------------------------------------------------
| Class Request
|--------------------------------------------------------------------------
| Purpose:
| Retrieves values(data) passed to application when a 
| request is submitted to the server. Works in 
| correlation to its parent class (Http).
|  
|      
*/
    
    /**
    * Depending on request method, data is fetched accordingly.
    * if a specific value is needed select the key to fetch.
    *
    * @return array
    */
    public function all($key = null)
    {
        switch($this->method()){
            case 'GET':
               return $this->get($key);
               break;
           
            case 'POST':
               return $this->post($key);
               break;
           
            case 'DELETE':
               return  $this->delete($key);
               break;
           
            case 'PUT':
               return $this->put($key);
               break;
        }
    }
    
    
    /**
    * Retrieves all GET values, if a specific value is needed
    * select the key to fetch
    * 
    * @param type $key string
    * @return string
    */
    public function get($key = null)
    {
        $query =  parse_url($_SERVER['REQUEST_URI'] , PHP_URL_QUERY );
        $get   =  explode('&' , $query);
        
        $arrayGet = [];
        foreach ($get as $value){
          $array = explode('=', $value);
          $arrayGet[$array[0]] = $array[1] ;
        }
        
        if(isset($key)){
            return $arrayGet[$key];
        }
        else{
            return $arrayGet;
        }
        
    }
    
    
    /**
    * Retrieves all POST values, if a specific value is needed
    * select the key to fetch
    * 
    * @param type $key string
    * @return string
    */
    public function post($key = null)
    {
        if(isset($key)){
            return $_POST[$key]; 
        }
        else{
            return $_POST;
        }
    }
    
    
    /**
    * Retrieves all PUT values, if a specific value is needed
    * select the key to fetch
    * 
    * @param type $key string
    * @return string
    */
    public function put($key = null)
    {
        $arrayPut = [];
        
        foreach ($this->method as $keyVal){
            
            $array = explode('=', $keyVal);
            
            if(!isset($array[1])){ $array[1] = null;}
            
            $arrayPut[$array[0]] = $array[1];
        }
        
        if(isset($key)){
            return $arrayPut[$key]; 
        }
        else{
            return $arrayPut;
        }
    }
    
    
    /**
    * Retrieves all DELETE values, if a specific value is needed
    * select the key to fetch
    * 
    * @param type $key string
    * @return string
    */
    public function delete($key = NULL)
    {
        $arrayDelete = [];
        
        foreach ($this->method as $keyVal){
            $array = explode('=' , $keyVal);
            if(!isset($array[1])){$array[1] = null;}
            
            $arrayDelete[$array[0]] = $array[1];
        }
        
        if(isset($key)){
            return $arrayDelete[$key];
        }
        else{
            return $arrayDelete;
        }
        
    }
 
   
}