<?php
 
namespace App\Core;  
  
use App\Core\Schema;


class Router 
{
    
/*
|-------------------------------------------------------------------------------
| Class Router
|-------------------------------------------------------------------------------
| Purpose: 
| Matches incomming Http request with application's declared routes.
|             
*/
    
    public $routes = [
        
        'GET'    =>  [ ],
        'PUT'    =>  [ ],
        'POST'   =>  [ ],
        'DELETE' =>  [ ]
    ];
    
    
    /**
    * Instatiates object while storing all declared
    * routes to object's property.
    *
    * @return \Router
    */
    static public function load($file)
    {
        $router = new self;

        require $file;
        
        return $router;
    }
    
    
    /**
    * Match stored GET route with incoming request.
    * 
    * @param type $uri string
    * @param type $controller string
    */
    public function get($uri , $controller)
    {
        $_uri = trim($uri, '/');
       
        $this->routes['GET'][$_uri] = $controller;
        
       
    }
    
    
    /**
    * Match stored PUT route with incoming request.
    * 
    * @param type $uri string
    * @param type $controller string
    */
    public function put($uri , $controller)
    {
        $_uri = trim($uri, '/');
        
        $this->routes['PUT'][$_uri] = $controller;
        
    }
    
    
    /**
    * Match stored POST route with incoming request.
    * 
    * @param type $uri string
    * @param type $controller string
    */
    public function post($uri , $controller)
    {
        $_uri = trim($uri, '/');
        
        $this->routes['POST'][$_uri] = $controller;
          
    }
    
    
    /**
    * Match stored DELETE route with incoming request.
    * 
    * @param type $uri string
    * @param type $controller string
    */
    public function delete($uri , $controller)
    {
        $_uri = trim($uri, '/');
        
        $this->routes['DELETE'][$_uri] = $controller;
          
    }
    
    /**
    * Validates the request URI corresponds to 
    * a defined route.
    *
    * @param type $uri string
    * @param type $method string
    * @throws Exception
    */
    public function validate($uri , $method)
    {
             
        if( !array_key_exists($uri, $this->routes[$method]) )
        {
            
//            throw new \Exception(
//                'No route define for this URL'
//                );
              return redirect();

        }
        
        $controller = explode('->' , $this->routes[$method][$uri]);
           
        $this->callObjMethod($controller[0], $controller[1]);
     
    }
    
    
    /**
    * Filter incoming request Methods & Uri
    * 
    * @param type $uri string 
    * @param type $method string
    * 
    */
    public function direct($uri, $method)
    {
        
        $this->validate($uri, $method);
        
    }
    
    
    /**
     * Instiates desires controller object and method.
     * according to their dependencies.
     * 
     * @param type $controller string
     * @param type $method  string
     * @return type Object
     * @throws \Exception
     */
    private function callObjMethod($controller, $method)
    {
        
        // Namespace accordingly
        $class = "\\App\\Controllers\\{$controller}";
        
        if(!method_exists($class, $method)) {
           
            throw new \Exception(
                
                "Class: {$controller} does not respond to {$method} >>action"
                );
        }
        
        return 
            (new Schema($class))->callMethod($method);
     
    }
    
     
}


