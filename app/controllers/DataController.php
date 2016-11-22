<?php

namespace App\Controllers;

use App\Model\User;
use App\Model\Amazon;
use App\Core\Request;
use App\Core\QueryBuilder;


class DataController 
{
    
    public function __construct(User $user)
    {
       
        if(!$user->auth('User'))
        {
            return redirect();
        }
    }
       
    
    public function show(QueryBuilder $query)
    {
        
       $query->selectAll('products')->orderBy('productID' , 'DESC');
       
       echo $query->records();
      
         
    }
      
      
    public function fetch(Request $requests , Amazon $amazon)
    {
        
        $amazon->setParams($requests->all());
                  
        echo $amazon->connectToAWS();
    }
      
      
    public function store(QueryBuilder $database, Request $requests)
    {

       $database->saveAll( 'products', $requests->all() );
        
    }
    
    
    
    public function destroy(QueryBuilder $database, Request $requests)
    {
        
        $database->delete( 'products' , 'productID', $requests->all('id'));
    }
    
        
    public function lab()
    {
        $username = 'jon_moreno';
        $password = '123password';
        
        var_dump(sha1($username.$password));
    }
    

}





