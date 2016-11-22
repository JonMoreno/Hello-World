<?php
  
namespace App\Controllers;

use App\Model\User;
use App\Core\Request;


class UsersController 
{
    
    
    
    
    
    public function logIn(User $user , Request $request )
    {
     
        if($user->isUser($request->all()))
        {
            $user->initSession('User');
            return view('home.html');              
        }
        
    }
    
    
    public function home(User $user)
    {
        
        if( !$user->auth('User') )
        {
            return redirect();
        }
        
        return view('home.html');
        
    }
    
    
    public function logOut(User $user)
    {
        
        $user->endLog();
        return redirect();
    }
    
}
  