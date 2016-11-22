<?php
  
namespace App\Core; 
  
  
class Http
{ 
/*
|-------------------------------------------------------------------------------
| Class Http
|-------------------------------------------------------------------------------
| Purpose: 
| This class helps check (Headers: Request Uri & Request Method).
| 
|     
*/ 
    
    public $method;
    
    public $uri;
     
    
    /**
    * Stores Http request-response method. 
    * 
    * @var array
    */
    public function __construct()
    {        
            
            $rawData      = fopen('php://input' , 'r');
                $storeRawData = '';
                while($data = fread($rawData, 1024))
                { $storeRawData .= $data; }
                fclose($rawData); 
                
             
            $method = explode('&' , $storeRawData); 
            
            array_push($method, strtoupper(filter_input(INPUT_SERVER, 'REQUEST_METHOD')));
                
            $this->method = $method;
            
    }
    
    
    /**
    * Request's method type is returned also supports
    * METHOD PUT and METHOD DELETE sent via forms.
    * GET | POST | DELETE | PUT
    * 
    * @var string
    */
    public function method()
    {        
        
       
        switch ($this->method)
        {
            case in_array('METHODDELETE', $this->method) || in_array('DELETE', $this->method):
                return 'DELETE';
                break;
            case in_array('METHODPUT', $this->method) || in_array('PUT', $this->method):  
                return 'PUT';
                break;
            case in_array('GET', $this->method): 
                return 'GET';
                break;
            case in_array('POST', $this->method):   
                return 'POST';
                break;

            default: 
                print'NOT A METHOD';    
        }
    }
    
    
    /**
    * Request's Uri is parsed 
    * 
    * @return string
    */
    public function uri()
    {
        
        $this->uri =
            strtolower(
                trim(
                    parse_url( 
                        filter_input(INPUT_SERVER,'REQUEST_URI') , PHP_URL_PATH 
                    ),'/'
                )
            );
        return  $this->uri;
        
    }
 
    
}

























































