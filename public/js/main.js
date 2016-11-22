
$(document).ready(function () 
{
    
/*
|-------------------------------------------------------------------------------
| Default variables.
|-------------------------------------------------------------------------------
*/

var load = "<div class='text-center' id='load'><br/><i class='fa fa-spinner fa-pulse fa-5x'></i><br/><span>Loading…</span></div>";
// Loading content.

var errorload  = "<div class='text-center' id='load'><br/><i class='fa fa-exclamation-circle fa-3x red'></i><br/><span>Please try again.</span></div>";
// Error loading content.

 
/*
|-------------------------------------------------------------------------------
| Function loadContent
|-------------------------------------------------------------------------------
|
| Purpose: Ajax request to load all Items.
|
*/ 
    function loadContent(method, url , marker) {
     
    $.ajax({
        type: method,
        url: url,
        datatype: 'JSON',
        timeout: 5000,
        
        // ---------------------------------------------------------------------
        // Function triggered before request is sent.
        // ------------------------------------------
        beforeSend: function() {
        
            $('#content-des').empty();
            
            $('#content-mob').empty();
            // Clear out element node for future use.
            
            $('.panel').append(load);
            // Set loading content.
        },
        
        // ---------------------------------------------------------------------
        // Function triggered before request is complete.
        // ----------------------------------------------
        complete: function() {
        
            $('#load').remove();
            // Remove loading content.
        },
        
        // ---------------------------------------------------------------------
        // Function triggered when request is successful.
        // ----------------------------------------------
        success: function(response) {
        
            var item = JSON.parse(response);
            // Store response object to be worked on.
         
            var newContent = ' ';
            // Format response for UI.
            var newContentMob = ' ';
            // Format response for UI.
       
                for (var i = 0; i < item.length; i++) { 
                // Loop through object
                    
                    // Desktop Display:
                    
                    newContent += "<tr id='"+item[i].ASIN+"'>";
                    newContent += '<td>'+'$' + item[i].Price + '</td>';  
                    newContent += '<td>' + item[i].MPN + '</td>';
                    newContent += '<td>' + item[i].Title + '</td>';
                    newContent += '<td>' + item[i].ASIN + '</td>';
                    newContent += '<td>';
                    newContent += "<form action='/app/delete/' method='POST'class='deleteItem'>";
                    newContent += "<input type='hidden' name='ASIN' value='"+item[i].ASIN+"'>";
                    newContent += "<input type='hidden' name='id' value='"+item[i].productID+"'>";
                    newContent += "<div class='text-center'>";
                    newContent += "<button type='submit' class='btn btn-default '>";
                    newContent += "<i style='color: crimson' class='fa fa-trash' aria-hidden='true'></i>";
                    newContent += "</button>";
                    newContent += "</div>";
                    newContent += "</form>";
                    newContent += '</td>';
                    newContent += '</tr>';
                    
                    
                    
                    // Mobile Display:
                    
                    newContentMob += "<div class='mob-table' id='"+item[i].ASIN+'1'+"'>";
                    
                    newContentMob += "<table class='table table-bordered table-hover text-center' style='margin-bottom: 0px;'>";                    
                    
                    newContentMob += '<tr>';
                    newContentMob += '<th class="info">';
                    newContentMob += '<i style="color: crimson" class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> Title';
                    newContentMob += '</th>';
                    newContentMob += '<th class="info">ASIN:</th>';
                    newContentMob += '</tr>';
                    newContentMob += '<tr>';
                    newContentMob += '<td>' + item[i].Title + '</td>';
                    newContentMob += '<td>' + item[i].ASIN + '</td>';
                    newContentMob += '</tr>';
                    newContentMob += '<tr>';
                    newContentMob += '<th class="info">Price:</th>';
                    newContentMob += '<th class="info">MPN:</th>';
                    newContentMob += '</tr>';
                    newContentMob += '<tr>';
                    newContentMob += '<td>' + "$" + item[i].Price+ '</td>';
                    newContentMob += '<td>' + item[i].MPN + '</td>';
                    newContentMob += '</tr>';
                    newContentMob += "</table>";
                    
                    
                    newContentMob += "<div class='text-center' style='padding: 5px;'>";
                    newContentMob += "<form action='/app/delete/' method='POST'class='deleteItemMob'>";
                    newContentMob += "<input type='hidden' name='ASIN' value='"+item[i].ASIN+"'>";
                    newContentMob += "<input type='hidden' name='id' value='"+item[i].productID+"'>";
                    newContentMob += "<button type='submit' class='btn btn-default btn-lg btn-block'>";
                    newContentMob += "Delete <i style='color: crimson' class='fa fa-trash-o fa-lg' aria-hidden='true'></i>"; 
                    newContentMob += "</button>";
                    newContentMob += "</form>";
                    newContentMob += "</div><br/><br/>";
                    
                    newContentMob += "</div>";
                    
                    
                    
                    
                }   
            
            // Mobile Display:
            $('#content-mob').append(newContentMob);
            // Desktop Display:
            $('#content-des').append(newContent);
            
            
            // Add new newContent.
            
            $('#content-des tr:gt(4)').hide();
            $('#content-mob .mob-table:gt(1)').hide();
            // Show only a few nodes.
                
            // -----------------------------------------------------------------
            // Mark newest item added to DOM.
            // ------------------------------
            if(marker === true){
                
                $("#content-des tr").first().hide().fadeIn(800).addClass('bg-success');
                
                setTimeout( function () {
                   $("#content-des tr").first().removeClass('bg-success');  
                }, 1000);
                
                $("#content-mob table").first().hide().fadeIn(800).addClass('bg-success');
                
                setTimeout( function () {
                   $("#content-mob table").first().removeClass('bg-success');  
                }, 1000);
            
            }
            
            // -----------------------------------------------------------------
            // Show all items.
            // ---------------
            else if(marker === false){
                
                $("#content-des").hide().fadeIn('slow');
                $("#content-mob").hide().fadeIn('slow');
            }
            
            
        },
        
        // ---------------------------------------------------------------------
        // Function triggered when request fails.
        // -------------------------------------
        error: function() {
        
           $('.panel').append(errorload);
        }
        
        });
    }
    
    
/*
|-------------------------------------------------------------------------------
| Function loadAwsContent
|-------------------------------------------------------------------------------
|
| Purpose: Ajax request to load AWS api products.
| 
*/
    function loadAwsContent(method, url, input) {
  
    $.ajax(
    {
        type: method,
        url: url,
        datatype: 'JSON',
        timeout: 30000,
        data: input,
        
        // ---------------------------------------------------------------------
        // Function triggered before request is sent.
        // -------------------------------------------
        beforeSend: function() {
        
            $('#load').remove();
            // Remove loading content.
            
            $('#resultsBox').empty();
            // Clear out element node for future use.
            
            $('#resultsBox').append(load);
            // Set loading content.
        },
        
        // ---------------------------------------------------------------------
        // Function triggered before request is complete.
        // ----------------------------------------------
        complete: function() {
            
            $('#load').remove();
            // Remove loading content.
        },
        
        // ---------------------------------------------------------------------
        // Function triggered when request is successful.
        // ----------------------------------------------
        success: function(response) {
            
            // ---------------------------------------------------------------------
            // Format reponse data to JSON.
            // ----------------------------
                var responseObj = JSON.parse(response);

            // ---------------------------------------------------------------------
            // Store reponse data into variable to be used.
            // -------------------------------------------



                var request = responseObj.Items.Request.IsValid;
                // Verify in request is valid.

                var requestKeywords = responseObj.Items.Request.ItemSearchRequest.Keywords;
                // Store keywords used with request.

                var item = responseObj.Items.Item;
                // Store items.

                var itemPage = responseObj.Items.Request.ItemSearchRequest.ItemPage;
                // Store current items page
            
                var changePage  = '';
        
            
            
            // -----------------------------------------------------------------
            // Validate response to api.
            // -------------------------
            if(request === 'True') {
                    
                // -------------------------------------------------------------
                // Sort Response.
                // --------------
                    if(responseObj.Items.TotalResults === '1') {
                    // Sort request by ASIN.
                                                
                        // Format response for UI.
                        var newContent = '';
                        
                            // HTML >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                            newContent += "<div id="+item.ASIN+">";
                            newContent +="<table class='table table-hover'>";
                            newContent +="<tr>";
                            newContent +="<td>";
                            newContent +="<div class='text-center'>";
                            newContent +="<a  data-toggle='collapse' href='#collapse"+item.ASIN+"' aria-expanded='false' aria-controls='collapse"+item.ASIN+"'>";
                            newContent +="<i class='fa fa-chevron-down'></i>";
                            newContent +="</a>";
                            newContent +="</div>";
                            newContent +="</td>";
                            newContent +="<th>ASIN</th>";
                            newContent +="<td>"+item.ASIN+"</td>";
                            newContent +="<td>";
                            newContent +="<form action='/app/store/' method='POST'class='results' id='"+item.ASIN+"'>";
                            newContent +="<input type='hidden' name='ASIN' value='"+item.ASIN+"'>";
                            newContent +="<input type='hidden' name='Title' value='"+item.ItemAttributes.Title+"'>";
                            newContent +="<input type='hidden' name='MPN' value='"+item.ItemAttributes.MPN+"'>";
                            newContent +="<input type='hidden' name='Price' value='"+item.Offers.Offer.OfferListing.Price.FormattedPrice+"'>";
                            newContent +="<div class='text-center'>";
                            newContent +="<button type='submit' class='btn btn-default '>";
                            newContent +="Add <i class='fa fa-plus-circle' aria-hidden='true'></i>";
                            newContent +="</button>";
                            newContent +="</div>";
                            newContent +="</form>";
                            newContent +="</td>";
                            newContent +="</tr>";
                            newContent +="</table>";
                            newContent += "<div class='collapse' id='collapse"+item.ASIN+"'>";
                            newContent += "<div class='well' >";
                            newContent += "<table class='results table table-bordered'>";
                            newContent += "<tr class='info'>";
                            newContent += "<th>MPN:</th><th>Price:</th";
                            newContent += "</tr>";
                            newContent += "<tr>";
                            newContent += "<td>"+item.ItemAttributes.MPN+"</td><td>"+item.Offers.Offer.OfferListing.Price.FormattedPrice+"</td>";
                            newContent += "</tr>";
                            newContent += "<tr class='info'>";
                            newContent += "<th>Image</th><th>Title:</th>";
                            newContent += "</tr>";
                            newContent += "<tr>";
                            newContent += "<td><img src='"+item.MediumImage.URL+"'/></td>";
                            newContent += "<td>"+item.ItemAttributes.Title+"</td>";
                            newContent += "</tr>";
                            newContent += "</table>";
                            newContent += "</div>";
                            newContent += "</div>";
                            newContent +="</div>";
                        
                        $('#resultsBox').append(newContent);
                        // Add new newContent
                        
                    }
                    else {
                    // Sort request by ALL.
                    
                        var i ;
                        for(i in item){
                        // Loop through object
                        
                        // Bypass any undefined values
                        item[i].ASIN === undefined ?
                        asin = '': asin = item[i].ASIN;
                        // Bypass undefined object properties
                        item[i].ItemAttributes === undefined ||
                        item[i].ItemAttributes.Title === undefined ? 
                        title= '': title = item[i].ItemAttributes.Title;
                        // Bypass undefined object properties
                        item[i].MediumImage === undefined ||
                        item[i].MediumImage.URL === undefined ? 
                        image = '#' : image = item[i].MediumImage.URL;
                        // Bypass undefined object properties
                        item[i].ItemAttributes === undefined ||
                        item[i].ItemAttributes.MPN === undefined ? 
                        mpn = '': mpn = item[i].ItemAttributes.MPN;
                        // Bypass undefined object properties
                        item[i].Offers === undefined ||
                        item[i].Offers.Offer === undefined ||
                        item[i].Offers.Offer.OfferListing === undefined ||
                        item[i].Offers.Offer.OfferListing.Price === undefined ||
                        item[i].Offers.Offer.OfferListing.Price.FormattedPrice === undefined? 
                        price = '': price = item[i].Offers.Offer.OfferListing.Price.FormattedPrice;
                        
                        // Format response for UI.
                        var newContent = " ";
                        
                            // HTML >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                            newContent += "<div id="+asin+">";
                            newContent +="<table class='table table-hover'>";
                            newContent +="<tr>";
                            newContent +="<td>";
                            newContent +="<div class='text-center'>";
                            newContent +="<a  data-toggle='collapse' href='#collapse"+asin+"' aria-expanded='false' aria-controls='collapse"+asin+"'>";
                            newContent +="<i class='fa fa-chevron-down'></i>";
                            newContent +="</a>";
                            newContent +="</div>";
                            newContent +="</td>";
                            newContent +="<th>ASIN</th>";
                            newContent +="<td>"+asin+"</td>";
                            newContent +="<td>";
                            newContent +="<form action='/app/store/' method='POST'class='addItem' id='"+asin+"'>";
                            newContent +="<input type='hidden' name='ASIN' value='"+asin+"'>";
                            newContent +="<input type='hidden' name='Title' value='"+title+"'>";
                            newContent +="<input type='hidden' name='MPN' value='"+mpn+"'>";
                            newContent +="<input type='hidden' name='Price' value='"+price+"'>";
                            newContent +="<div class='text-center'>";
                            newContent +="<button type='submit' class='btn btn-default '>";
                            newContent +="Add <i class='fa fa-plus-circle' aria-hidden='true'></i>";
                            newContent +="</button>";
                            newContent +="</div>";
                            newContent +="</form>";
                            newContent +="</td>";
                            newContent +="</tr>";
                            newContent +="</table>";
                            newContent += "<div class='collapse' id='collapse"+asin+"'>";
                            newContent += "<div class='well' >";
                            newContent += "<table class='results table table-bordered'>";
                            newContent += "<tr class='info'>";
                            newContent += "<th>MPN:</th><th>Price:</th";
                            newContent += "</tr>";
                            newContent += "<tr>";
                            newContent += "<td>"+mpn+"</td><td>"+price+"</td>";
                            newContent += "</tr>";
                            newContent += "<tr class='info'>";
                            newContent += "<th>Image</th><th>Title:</th>";
                            newContent += "</tr>";
                            newContent += "<tr>";
                            newContent += "<td><img src='"+image+"'/></td>";
                            newContent += "<td>"+title+"</td>";
                            newContent += "</tr>";
                            newContent += "</table>";
                            newContent += "</div>";
                            newContent += "</div>";
                            newContent +="</div>";
                            
                        $('#resultsBox').append(newContent);
                        // Add new newContent,
                        }
                    
                    // ---------------------------------------------------------
                    // Next Page Buttons.
                    // ------------------
                    changePage +="<hr/>";
                    changePage +="<form action='#' method='' class='nextPage'>";
                    changePage +="<input type='hidden' name='ItemPage' value='"+itemPage+"' />";
                    changePage +="<input type='hidden' name='Keywords' value='"+requestKeywords+"' />";
                    changePage +="<div class='pull-right'>";
                    changePage +="<button class='btn btn-default' id='nextPage'>Next Page <i class='fa fa-arrow-right' aria-hidden='true'></i></button>";
                    changePage +="</div>";
                    changePage +="</form>";
                                                    
                    changePage +="<form action='#' method='' class='previousPage'>";
                    changePage +="<input type='hidden' name='ItemPage' value='"+itemPage+"' />";
                    changePage +="<input type='hidden' name='Keywords' value='"+requestKeywords+"' />";
                    changePage +="<div class='pull-left'>";
                    changePage +="<button class='btn btn-default' id='previousPage'><i class='fa fa-arrow-left' aria-hidden='true' style='border-radious: 45px;'></i> Previous Page</button>";
                    changePage +="</div>";
                    changePage +="</form>";

                    $('#resultsBox').append(changePage);
                     
                    if (itemPage === '4'){
                                 
                        $('#nextPage').attr('disabled', true);
                 
                    }
                    else if (itemPage === '1'){
                                                  
                        $('#previousPage').attr('disabled', true);
                 
                    }
                    
                }
                    
            } 
            // -----------------------------------------------------------------
            // Response to AWS api is in-valid.
            // --------------------------------
            else if(request  === 'False') {
                
                    $('#results').remove();
                    // Remove old newContent
                    
                    $('#resultsBox').append(errorload);
                    // Add error newContent
            }
        },
        
        // ---------------------------------------------------------------------
        // Function triggered when request fails.
        // --------------------------------------
        error: function() {
        
            $('#resultsBox').append(errorload);
 
        }
        
    });
    
    }
   
    
/*
|-------------------------------------------------------------------------------
| Function storeContent
|-------------------------------------------------------------------------------
|
| Purpose: Ajax request to store AWS api Item.
| 
*/
    function storeContent(method, url, input, marker) {
    $.ajax({
        method: method,
        url: url,
        data: input,
        
        // ---------------------------------------------------------------------
        // Function triggered when request is successful.
        // ----------------------------------------------
        success: function() {
                        
            loadContent('GET' , '/app/records/', true);
            //Reload DOM with newest item
            
            $("#"+marker+"").fadeOut('slow', function ()
            // Remove from DOM added item.
            {
                $(this).remove();
            });
//            $("#"+marker+"1"+"").fadeOut('slow', function ()
//            // Remove from DOM added item.
//            {
//                $(this).remove();
//            });
            
        },
        
        // ---------------------------------------------------------------------
        // Function triggered when request fails.
        // --------------------------------------
        error: function() {
            
            $('#resultsBox').append(errorload);
            
        }
    });
    }


/*
|-------------------------------------------------------------------------------
| Function deleteContent
|-------------------------------------------------------------------------------
|
| Purpose: Ajax request to delete Item from records.
| 
*/
    function deleteContent(method, url, input, marker) {
    $.ajax({
        method: method,
        url: url,
        data: input,
        // ---------------------------------------------------------------------
        // Function triggered when request is successful.
        // ----------------------------------------------
        success: function() {
                        
            
            
            $("tr #"+marker+"").fadeOut('slow', function ()
            // Remove from DOM added item.
            {
                $(this).remove();
            });
            
            $("div #"+marker+"1"+"").fadeOut('slow', function ()
            // Remove from DOM added item.
            {
                $(this).remove();
            });
            
            loadContent('GET' , '/app/records/', false);
            //Reload DOM with newest item
            
        },
        
        // ---------------------------------------------------------------------
        // Function triggered when request fails.
        // --------------------------------------
        error: function() {
            
            $('#resultsBox').append(errorload);
            
        }
            
        });
    }
    
    
/*
|-------------------------------------------------------------------------------
| Event Handlers
|-------------------------------------------------------------------------------          
*/    

    //--------------------------------------------------------------------------
    // Load DOM with initial items.
    //----------------------------        
    $(document).ready(function () 
    {
        loadContent('get' , '/app/records/', false);
    });   
    
    
    
    //--------------------------------------------------------------------------
    // Form event handlers.
    //---------------------        
    $(document).on('submit', 'form', 'click', function(e){
    
        e.preventDefault();
        // Prevente default behaviour.
        
        var $this = $(this);
        // Store form reference.
         
        var url  = $(this).attr('action');
        // Cache action=url
        
        
        //----------------------------------------------------------------------
        // Load Items from API.
        //--------------------- 
        if($this.hasClass('search')) {
            
            var searchBox = $this.find('input[name="Keywords"]').val();
            
            if(searchBox.length <= 2){
                $('.help-block').remove();
                $('.search').append("<div class='help-block text-center'><code>Please!</code> Search by Keywords or ASIN</div>");
                $('#search-group').addClass('has-warning');
                $('#resultsBox').empty();
            }
            else if(searchBox.length > 2){
                $('.help-block').remove();
                var details = $this.serialize();
                loadAwsContent('POST', url , details);
              
            }
            
            
        }
        
        
        //----------------------------------------------------------------------
        // Load next page with items.
        //--------------------------- 
        else if($this.hasClass('nextPage')){
            
            $this.find('input[name="ItemPage"]').val( Number($this.find('input[name="ItemPage"]').val())+1 );
            
                      
            loadAwsContent('POST', '/app/aws/',  $this.serialize());
            
        } 
        
        
        //----------------------------------------------------------------------
        // Load previous page with items.
        //------------------------------- 
        else if($this.hasClass('previousPage')){
            
            var previousPage = $this.find('input[name="ItemPage"]').val( Number($this.find('input[name="ItemPage"]').val())-1 );
              
            
            loadAwsContent('POST', '/app/aws/',  $this.serialize());
        }
        
        
        //----------------------------------------------------------------------
        // Store Item from API.
        //---------------------- 
        else if($this.hasClass('addItem')){
            
            var details = $this.serialize();
            var marker = $this.find('input[name="ASIN"]').val();
            
            storeContent('POST', url, details, marker);

        }
        
        
        //----------------------------------------------------------------------
        // Delete Item from records.
        //-------------------------- 
        else if($this.hasClass('deleteItem')){
            
            var details = $this.serialize();
            var marker = $this.find('input[name="ASIN"]').val();
            
            deleteContent('POST', url, details, marker);
        }
        //----------------------------------------------------------------------
        // Delete Item from records Mobile
        //-------------------------- 
        else if($this.hasClass('deleteItemMob')){
            
            var details = $this.serialize();
            var marker = $this.find('input[name="ASIN"]').val();
            
            deleteContent('POST', url, details, marker);
        }
        
        
        
        
        
    });
        
        
    //--------------------------------------------------------------------------
    // Toggle all Items.
    //----------------
    $('#moreRecords').on('click', function(e){
        e.preventDefault();
        $('#content-des  tr:gt(4)').toggle();
        $('#content-mob  .mob-table:gt(1)').toggle();
    });
    
    
    
    // ByPass Ajax not loading into history Object.
    window.onpopstate = function () {
        var path = location.href;
        window.location.replace(path);
    };
   
   
    
});
