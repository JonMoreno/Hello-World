
$(document).ready(function () 
{
/*
|-------------------------------------------------------------------------------
| Default variables.
|-------------------------------------------------------------------------------
*/

var load = "<div class='text-center' id='load'><br/><i class='fa fa-spinner fa-pulse fa-2x'></i><br/><span>Attempting to<br/>Log you in...</span></div>";
// Loading content.

var errorload  = "<div class='text-center' id='load'><br/><i class='fa fa-exclamation-circle fa-3x red'></i><br/><span>Please try again.</span></div>";
// Error loading content.

var message = "<div class='text-center' id='message'><div class='btn btn-danger btn-block'>Incorrect username or password</div><br/></div>";
// Log In error message.
    
/*
|-------------------------------------------------------------------------------
| Function attemptLogIn
|-------------------------------------------------------------------------------
|
| Purpose: Ajax request attempting Lon In.
|
*/  

    function attemptLogIn(method, url, input) {
    $.ajax(
    {
        type: method,
        url: url,
        datatype: 'HTML',
        data: input,
        
        // ---------------------------------------------------------------------
        // Function triggered before request is sent.
        // -------------------------------------------
        beforeSend: function() {
            
            $('#load').remove();
            $('#message').remove();
            $('.panel-body').append(load);
            
        },
        
        // ---------------------------------------------------------------------
        // Function triggered before request is complete.
        // ----------------------------------------------
        complete: function() {
            
            $('#load').remove();
            
        },
        
        // ---------------------------------------------------------------------
        // Function triggered when request is successful.
        // ----------------------------------------------
        success: function(response) {
          

            if(response.length === 0) {
                
            // Log in failed  
                $('.panel-body').prepend(message);
                
            }else {
                
            // Log in succesful.
                $('.syncNode').html($(response).find('.childSyncNode')).append();
                
                window.history.pushState("object or string", "Title", "/app/home");

            }
            
        },
        
        // ---------------------------------------------------------------------
        // Function triggered when request fails.
        // --------------------------------------
        error: function() {
            
            $('.panel-body').append(errorload);
            
        }
    });
    }
    
    
    
    
/*
|-------------------------------------------------------------------------------
| Event Handlers
|-------------------------------------------------------------------------------          
*/
    //--------------------------------------------------------------------------
    // Form events.
    //-------------
    $(document).on('submit', 'form' , 'click' , function(e){
        
        e.preventDefault();
        
        var $this = $(this);
        
        var url = $this.attr('action');
        
        var userName = $this.find('input[name="userName"]').val();
        var password = $this.find('input[name="password"]').val();
        
        var input = $this.serialize();
        
        //----------------------------------------------------------------------
        // Attempt Log In.
        //---------------- 
        if($this.hasClass('logIn')) {
            
            if(userName.length < 2 || password.length <2) {
                $('.help-block').remove();
                $('#userName').after("<div class='help-block'><code>User Name Required</code></div>");
                $('#password').after("<div class='help-block'><code>Password Required</div>");
            }
            else{
                $('.help-block').remove();
                attemptLogIn('POST', url , input);
            }
            
        }
        
    });
    
     
    // ByPass Ajax not loading into history Object.
    // Force refresh/back/foward.
    window.onpopstate = function () {
        var path = location.href;
        window.location.replace(path);
    };
    
    
  
});
