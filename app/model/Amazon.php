<?php
  
namespace App\Model;


class Amazon
{
/*
|-------------------------------------------------------------------------------
| Class Amazon:
|-------------------------------------------------------------------------------
| Purpose:
| Comunicates with AWS API. 
| 
|       
*/
    
    public $awsSecretKey = "NOT DISCLOUSED";
    
    public $endpoint = "webservices.amazon.com";
    
    public $uri = "/onca/xml";   
    
    public $requestMethod = 'GET';
    
    public $params;
    
    public $requestUrl; 
    
    public $itemPage = 1;

    
    /**
    * Main configuration values.
    * File location: config.php
    * 
    * @param type $params array.
    */
    public function __construct($params)
    {
        
       $this->params = $params; 
       
    }
    
    
   /**
    * Set incoming request search values.
    * 
    * @param type $params array.
    */
    public function setParams($params)
    {
        
           $this->params['Operation'] = 'ItemSearch';
           $this->params['SearchIndex'] = 'All';
           $this->params['Keywords'] = $params['Keywords'];
           $this->params['ResponseGroup'] = "Images,ItemAttributes,Offers";
           $this->params['ItemPage'] = $params['ItemPage'];
           
    }
    
    
    /**
    *  AWS Api require a canonical url
    * once this method is execute url
    * is ready to be sent to api.
    *
    * @return type string
    */
    public function createCanonicalQuery()
    {
        
       // Sort the parameters by key
        ksort($this->params);

        $pairs = array();

        foreach ($this->params as $key => $value) {
            array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
        }

        // Generate the canonical query
        $canonical_query_string = join("&", $pairs);

        // Generate the string to be signed
        $string_to_sign = "$this->requestMethod\n".$this->endpoint."\n".$this->uri."\n".$canonical_query_string;

        // Generate the signature required by the Product Advertising API
        $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $this->awsSecretKey, TRUE));

        // Generate the signed URL
        $this->requestUrl = 'http://'.$this->endpoint.$this->uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);
        
        return $this->requestUrl;
        
    }
    
    
    /**
    * Gathers all necessary data and 
    * connects with AWS API.
    *     
    * @return type json.
    */
    public function  connectToAWS()
    {
        
        $readyUrl = $this->createCanonicalQuery();
        
        $curl = curl_init($readyUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($curl);
            curl_close($curl);
        $xml = simplexml_load_string($data);   
        $json = json_encode($xml , JSON_FORCE_OBJECT);      
  
        return $json;
    
    }


    
}

 