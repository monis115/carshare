//  getTrips
getTrips();

// create a geocoder object to use geocode
var geocoder=new google.maps.Geocoder();

$(function(){
//     fix the map
$("#addtripModal").on('shown.bs.modal',function(){
    google.maps.event.trigger(map,"resize");
});


          
});

// hide all date time and checkboxes inputs
$('.regular').hide();
$('.one-off').hide();
$('.regular2').hide();
$('.one-off2').hide();
$('.moreinfo').hide();
var myRadio=$('input[name="regular"]');
myRadio.click(function(){
    if($(this).is(':checked')){
        if($(this).val()=="Y"){
          
            $('.one-off').hide();
            $('.regular').show();
        }else{
            $('.regular').hide();
           $('.one-off').show();
        }
        
    }
});
var myRadio=$('input[name="regular2"]');
myRadio.click(function(){
    if($(this).is(':checked')){
        if($(this).val()=="Y"){
          
            $('.one-off2').hide();
            $('.regular2').show();
        }else{
            $('.regular2').hide();
           $('.one-off2').show();
        }
        
    }
});

$('#date, #date2').datepicker({
    showAnim: "fadeIn",
    numberOfMonths: 1,
    dateFormat: "D d M, yy",
    minDate: +1,
    maxDate: "+12M",
    showWeek: true
});


//  click on create trip button
var data;
$("#addtripform").submit(function(event){
    $("#spinner").show();
    $("#addtripmessage").hide();
    event.preventDefault();
    data=$(this).serializeArray();
    getAddTripsDepartureCoordinates();
});


// define  getAddTripsDepartureCoordinates()

function getAddTripsDepartureCoordinates()
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
                getAddTripsDestinationCoordinates();

            }else{
                getAddTripsDestinationCoordinates();

            }
        }
    )
}
// define  getAddTripsDestinationCoordinates()

function getAddTripsDestinationCoordinates()
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
                submitAddTripRequest();
              

            }else{
                submitAddTripRequest();

             

            }
        }
    )
}

function  submitAddTripRequest(){

    $.ajax({
        url: "addtrip.php",
        type: "POST",
        data: data,
        success: function(data){ // AJAX call successful:show error or success message
            $("#spinner").hide();
            if(data)
            {
               
                $("#addtripmessage").html(data);
                $("#addtripmessage").slideDown();
            }else{
            //     hide modal
            $("#addtripModal").modal('hide');
            //  reset form
            $("#addtripform")[0].reset();
            //  load trips 
            getTrips();
            }
           
        },
        error: function(){ // AJAX call fails:show ajax call error
            $("#spinner").hide();
            $("#addtripmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            $("#addtripmessage").slideDown();
            
        }
    
    });

}

function getTrips(){
    $("#spinner").show();

    
    $.ajax({
     
        url: "gettrips.php",
        success: function(data){ // AJAX call successful:show error or success message
            $("#spinner").hide();
          $("#myTrips").html(data);
          $("#myTrips").hide();
          $("#myTrips").slideDown();
        
           
        },
        error: function(){ // AJAX call fails:show ajax call error
            $("#spinner").hide();
            $("#myTrips").hide();


            $("#myTrips").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            $("#myTrips").fadeIn();
            
        }
    
    });
    
}


//  click on Edit button inside the trip

$("#edittripModal").on('show.bs.modal',function(event){
    $("#edittripmessage").empty();
    //  button whhich  open the Modal
    var $invoker=$(event.relatedTarget);
    $.ajax({
        url: "gettripdetails.php",
        method:"POST",
        data:{trip_id:$invoker.data('trip_id')},
        success: function(data){ // AJAX call successful:show error or success message
             if(data){
                if(data=='error'){
                    $("#edittripmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                } else{
                      trip=JSON.parse(data);
                      formatModal();
                }
             }
           
        },
        error: function(){ // AJAX call fails:show ajax call error
            $("#edittripmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
       
    
    });

    $("#edittripform").submit(function(event){
        $("#spinner").show();
         $("#edittripmessage").hide();
        // $("#edittripmessage").empty();
        event.preventDefault();
        data=$(this).serializeArray();
        data.push({name:'trip_id',value:$invoker.data('trip_id')});
        getEditTripsDepartureCoordinates();
    })

    $("#deletetrip").click(function(){
        $("#spinner").show();
        $("#edittripmessage").hide();

        $.ajax({
            url: "deletetrip.php",
            method:"POST",
            data:{trip_id:$invoker.data('trip_id')},
            success: function(data){ 
                // AJAX call successful:show error or success message
                $("#spinner").hide();
                 if(data)
                 {  
                 $("#edittripmessage").html("<div class='alert alert-danger'>Trip Could not be deleted try again Later</div>");
                 $("#edittripmessage").slideDown();

                   

                 }else{
                    $("#edittripModal").modal('hide');
                   getTrips();

                 }
               
            },
            error: function(){ // AJAX call fails:show ajax call error
                $("#spinner").hide();
                $("#edittripmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
                $("#edittripmessage").slideDown();

                
            }
           
        
        });



    });




});
function getEditTripsDepartureCoordinates()
{
    geocoder.geocode(
        {
            'address':document.getElementById("departure2").value
        },
        function(results,status){
            if(status==google.maps.GeocoderStatus.OK){
                departureLongitude=results[0].geometry.location.lng();
                departureLatitude=results[0].geometry.location.lat();
                data.push({name:'departureLongitude',value:departureLongitude});
                data.push({name:'departureLatitude',value:departureLatitude});
                getEditTripsDestinationCoordinates();

            }else{
                getEditTripsDestinationCoordinates();

            }
        }
    ) 
}
function getEditTripsDestinationCoordinates()
{
    geocoder.geocode(
        {
            'address':document.getElementById("destination2").value
        },
        function(results,status){
            if(status==google.maps.GeocoderStatus.OK){
                destinationLongitude=results[0].geometry.location.lng();
                destinationLatitude=results[0].geometry.location.lat();
                data.push({name:'destinationLongitude',value:destinationLongitude});
                data.push({name:'destinationLatitude',value:destinationLatitude});
                submitEditTripRequest();
              

            }else{
                submitEditTripRequest();

             

            }
        }
    )
}
function  submitEditTripRequest(){

    $.ajax({
        url: "updatetrips.php",
        type: "POST",
        data: data,
        success: function(data){ // AJAX call successful:show error or success message
            $("#spinner").hide();
            if(data)
            {
               
                $("#edittripmessage").html(data);
                $("#edittripmessage").slideDown();
            }else{
            //     hide modal
            $("#edittripModal").modal('hide');
            //  reset form
            $("#edittripform")[0].reset();
            //  load trips 
            getTrips();
            }
           
        },
        error: function(){ // AJAX call fails:show ajax call error
            $("#spinner").hide();
            $("#edittripmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            $("#edittripmessage").slideDown();
            
        }
    
    });

}


function formatModal()
{
    $("#departure2").val(trip['departure']);
    $("#destination2").val(trip['destination']);
    $("#price2").val(trip['price']);
    $("#seatsavailable2").val(trip['seatsavailable']);
    if(trip['regular']=='Y')
    {
        $("#yes2").prop('checked',true);
        $("#monday2").prop('checked',trip['monday']=="1"?true :false);
        $("#tuesday2").prop('checked',trip['tuesday']=="1"?true :false);
        $("#wednesday2").prop('checked',trip['wednesday']=="1"?true :false);
        $("#thrusday2").prop('checked',trip['thrusday']=="1"?true :false);
        $("#friday2").prop('checked',trip['friday']=="1"?true :false);
        $("#saturday2").prop('checked',trip['saturday']=="1"?true :false);
        $("#sunday2").prop('checked',trip['sunday']=="1"?true :false);
        $("#time2").val(trip["time"]);
        $(".one-off2").hide();
        $(".regular2").show();

        

    }else
    {
        $("#no2").prop('checked',true);
        $("#time2").val(trip["time"]);
        $("#date2").val(trip[""]);
    }
}



