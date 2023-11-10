// Ajax Call for the sign up form
// once the form is submitted 
$("#signupform").submit(function(event){ 
    $("#spinner").show();
    $("#signupmessage").hide();
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: datatopost,
        success: function(data){ // AJAX call successful:show error or success message
            if(data){
                $("#spinner").hide();
                $("#signupmessage").html(data);
                $("#signupmessage").slideDown();
            }
        },
        error: function(){ // AJAX call fails:show ajax call error
            $("#spinner").hide();
            $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            $("#signupmessage").slideDown();
            
        }
    
    });

});





    
    
        
       
 
        
$("#loginform").submit(function(event){ 
    $("#spinner").show();
    $("#loginmessage").hide();
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to login.php using AJAX
    $.ajax({
        url: "login.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            if(data=="success"){
                window.location = "mainPage.php";
            }else{
                $("#spinner").hide();
                $('#loginmessage').html(data);   
                $("#loginmessage").slideDown();

                
            }
        },
        error: function(){
            $("#spinner").hide();
            $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            $("#loginmessage").slideDown();

            
        }
    
    });

});

//Ajax Call for the forgot password form
//Once the form is submitted
$("#forgotpasswordform").submit(function(event){ 
    $("#spinner").show();
    $("#forgotpasswordmessage").hide();
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "forgot-password.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            $("#spinner").hide();
            
            $('#forgotpasswordmessage').html(data);
            $("#forgotpasswordmessage").slideDown();
        },
        error: function(){
            $("#spinner").hide();
            $("#forgotpasswordmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            $("#forgotpasswordmessage").slideDown();
            
        }
    
    });

});

var data;

$("#searchForm").submit(function(event){
     $("#spinner").show();
     $("#searchResults").fadeOut();
    event.preventDefault();
    data= $(this).serializeArray();
    getSearchDepartureCoordinates();
    
});

// create a geocoder object to use geocode
var geocoder=new google.maps.Geocoder();
function getSearchDepartureCoordinates()
{
    geocoder.geocode(
        {
            'address':document.getElementById("departure").value
        },
        function(results,status){
            if(status==google.maps.GeocoderStatus.OK){
                departureLongitude=results[0].geometry.location.lng();
                departureLatitude=results[0].geometry.location.lat();
                data.push({name:'departureLongitude',value:departureLongitude});
                data.push({name:'departureLatitude',value:departureLatitude});
                getSearchDestinationCoordinates();

            }else{
                getSearchDestinationCoordinates();

            }
        }
    )
}

function  getSearchDestinationCoordinates()
{
    geocoder.geocode(
        {
            'address':document.getElementById("destination").value
        },
        function(results,status){
            if(status==google.maps.GeocoderStatus.OK){
                destinationLongitude=results[0].geometry.location.lng();
                destinationLatitude=results[0].geometry.location.lat();
                data.push({name:'destinationLongitude',value:destinationLongitude});
                data.push({name:'destinationLatitude',value:destinationLatitude});
                submitSearchRequest();
              

            }else{
                submitSearchRequest();

             

            }
        }
    )
}

function submitSearchRequest()
{
    
    // $.ajax({
    //     url: "search.php",
    //     type: "POST",
    //     data: data,
    //     success: function(data){ // AJAX call successful:show error or success message
    //         $("#searchResults").html(data);
    //         $("#tripResults").accordion({
    //             icons: false,
    //             active:false,
    //             collapsible: true,
    //             heightStyle: "content"

    //         });
            
           
    //     },
    //     error: function(){ // AJAX call fails:show ajax call error
    //         $("#searchResults").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
    //     }
    
    // });
      
    $.ajax({
        url: "search.php",
        data: data,
        type: "POST",
        success: function(data2){

             $("#spinner").hide();
            if(data2){
                $('#searchResults').html(data2);
                //accordion
              
            }
            $("#searchResults").fadeIn();
          
    },
        error: function(){
            $("#spinner").hide();
            $("#searchResults").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            $("#searchResults").fadeIn();

}
    }); 
}





