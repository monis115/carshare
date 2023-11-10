
<?php
session_start();
include('connection.php');
$user_id=$_SESSION['user_id'];
// get username
$sql="select * from users where user_id='$user_id'";
$result=mysqli_query($link,$sql);
$count=mysqli_num_rows($result);
if($count==1)
{
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $email=$row["email"];
    $user=$row["last_name"];

}else
{
    echo "<div class='alert alert-danger'> There was an error retrieving  the username from database </div>";
}



//start session and connect to database
// session_start();
// include('connection.php');
// include('booknow.js');

//define error messages
$missingdeparture = '<p><strong>Please enter your departure!</strong></p>';
$invaliddeparture = '<p><strong>Please enter a valid departure!</strong></p>';
$missingdestination = '<p><strong>Please enter your destination!</strong></p>';
$invaliddestination = '<p><strong>Please enter a valid destination!</strong></p>';

//Get inputs:
@$departure = $_POST["departure"];
@$destination = $_POST["destination"];
@$errors="";

//check coordinates
if(!isset($_POST["departureLatitude"]) or !isset($_POST["departureLongitude"])){
    $errors .= $invaliddeparture;   
}else{
    @$departureLatitude = $_POST["departureLatitude"];
    @$departureLongitude = $_POST["departureLongitude"];
}

if(!isset($_POST["destinationLatitude"]) or !isset($_POST["destinationLongitude"])){
    $errors .= $invaliddestination;   
}else{
    @$destinationLatitude = $_POST["destinationLatitude"];
    @$destinationLongitude = $_POST["destinationLongitude"];
}

//set search radius
$searchRadius = 10;

//min max Departure Longitude
$deltaLongitudeDeparture = $searchRadius*360/(24901*cos(deg2rad(@$departureLatitude)));
$minLongitudeDeparture = @$departureLongitude - $deltaLongitudeDeparture;
if($minLongitudeDeparture < -180){
    $minLongitudeDeparture += 360;
}
$maxLongitudeDeparture = @$departureLongitude + $deltaLongitudeDeparture;
if($maxLongitudeDeparture > 180){
    $maxLongitudeDeparture -= 360;
}

//min max Destination Longitude
$deltaLongitudeDestination = $searchRadius*360/(24901*cos(deg2rad(@$destinationLatitude)));
$minLongitudeDestination = @$destinationLongitude - $deltaLongitudeDestination;
if($minLongitudeDestination < -180){
    $minLongitudeDestination += 360;
}
$maxLongitudeDestination =@$destinationLongitude + $deltaLongitudeDestination;
if($maxLongitudeDestination > 180){
    $maxLongitudeDestination -= 360;
}

//min max Departure Latitude
$deltaLatitudeDeparture = $searchRadius*180/12430;
$minLatitudeDeparture = @$departureLatitude - $deltaLatitudeDeparture;
if($minLatitudeDeparture < -90){
    $minLatitudeDeparture = -90;
}
$maxLatitudeDeparture =@ $departureLatitude + $deltaLatitudeDeparture;
if($maxLatitudeDeparture > 90){
    $maxLatitudeDeparture = 90;
}

//min max Destination Latitude
$deltaLatitudeDestination = $searchRadius*180/12430;
$minLatitudeDestination = @$destinationLatitude - $deltaLatitudeDestination;
if($minLatitudeDestination < -90){
    $minLatitudeDestination = -90;
}
$maxLatitudeDestination = @$destinationLatitude + $deltaLatitudeDestination;
if($maxLatitudeDestination > 90){
    $maxLatitudeDestination = 90;
}

//Check departure:
if(!$departure){
    $errors .= $missingdeparture;   
}else{
    $departure = filter_var($departure, FILTER_SANITIZE_STRING); 
}

//Check destination:
if(!$destination){
    $errors .= $missingdestination;   
}else{
    $destination = filter_var($destination, FILTER_SANITIZE_STRING); 
}

//if there is an error print error message
if($errors){
    $resultMessage = '<div class=" alert alert-danger">' . $errors . '</div>';
    echo $resultMessage; exit;
}

//get all available trips in the carsharetrips table
$myArray = [$minLongitudeDeparture < $maxLongitudeDeparture, $minLatitudeDeparture < $maxLatitudeDeparture, $minLongitudeDestination < $maxLongitudeDestination, $minLatitudeDestination < $maxLatitudeDestination];

$queryChoice1 = [
    " (departureLongitude BETWEEN $minLongitudeDeparture AND $maxLongitudeDeparture)",
    " AND (departureLatitude BETWEEN $minLatitudeDeparture AND $maxLatitudeDeparture)",
    " AND (destinationLongitude BETWEEN $minLongitudeDestination AND $maxLongitudeDestination)",
    " AND (destinationLatitude BETWEEN $minLatitudeDestination AND $maxLatitudeDestination)"
];

$queryChoice2 = [
    " ((departureLongitude > $minLongitudeDeparture) OR (departureLongitude < $maxLongitudeDeparture))",
    " AND (departureLatitude BETWEEN $minLatitudeDeparture AND $maxLatitudeDeparture)",
    " AND ((destinationLongitude > $minLongitudeDestination) OR (destinationLongitude < $maxLongitudeDestination))",
    " AND (destinationLatitude BETWEEN $minLatitudeDestination AND $maxLatitudeDestination)"
];

$queryChoices = [$queryChoice2, $queryChoice1];

$sql = "SELECT * FROM carsharetrips WHERE ";

for ($value=0; $value<4; $value++) {
    $index = $myArray[$value];
    $sql .= $queryChoices[$index][$value];
}

$result = mysqli_query($link, $sql);
if(!$result){
    echo "ERROR: Unable to excecute: $sql. " . mysqli_error($link); exit;   
}

if(mysqli_num_rows($result) == 0){
    echo "<div class='alert alert-info noresults'>There are no journeys matching your search!</div>"; exit;
}

echo "<div class='alert alert-info journeysummary'>From $departure to $destination.<br /><div><button type='button' id='bookNow' class='btn btn-info btn-md' data-toggle='modal' data-backdrop='false'>Book Now</div> </div>
";            
echo '<div id="message">'; 

//cycle through trips and find close ones

//retrieve each row in $result
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    
    //check if the trip date is in the past
    $dateOK = 1;
    if($row['regular']=="N"){
        $source = $row['date'];
        $tripDate = DateTime::createFromFormat('D d M, Y', $source);
        $today = date("D d M, Y");
        $todayDate = DateTime::createFromFormat('D d M, Y', $today);
        $dateOK = ($tripDate > $todayDate);
    }
    
    //if date is ok
    if($dateOK){
        //print trip
        
        //get trip user id
        $person_id = $row['user_id'];
        
        //run query to get user details
        $sql2="SELECT * FROM users WHERE user_id='$person_id' LIMIT 1";
        $result2 = mysqli_query($link, $sql2);
        
        if($result2){
            
            //get user details
            $row2 = mysqli_fetch_array($result2);
            
            //Get phone number:
            @$user_id=$_SESSION['user_id'];
            if($user_id){
             $phonenumber = $row2['phonenumber'];   
            }else{
             $phonenumber = "Please sign up! Only members have access to contact information.";   
            }
            
            //get picture
            $picture = $row2['profilepicture'];
            //get firstname
            $firstname = $row2['first_name'];
            
            //get gender
            $gender = $row2['gender'];
            
            //more information
            $moreInformation = $row2['moreinformation'];
            
            //get trip departure
            $tripDeparture = $row['departure'];
            
            //get trip destination
            $tripDestination = $row['destination'];
            
            //get trip price
            $tripPrice = $row['price'];
            
            //get seats available in the trip
            $seatsAvailable = $row['seatsavailable'];
            
            //Get trip frequency and time:
            if($row['regular']=="N"){
                $frequency = "One-off journey.";
                $time = $row['date']." at " .$row['time'].".";
            }else{
                $frequency = "Regular."; 
                $array = [];
                    if($row['monday']==1){array_push($array,"Mon");}
                    if($row['tuesday']==1){array_push($array,"Tue");}
                    if($row['wednesday']==1){array_push($array,"Wed");}
                    if($row['thursday']==1){array_push($array,"Thu");}
                    if($row['friday']==1){array_push($array,"Fri");}
                    if($row['saturday']==1){array_push($array,"Sat");}
                    if($row['sunday']==1){array_push($array,"Sun");}
                $time = implode("-", $array)." at " .$row['time'].".";
            }
            
            //print trip
            echo 
             "<div class='tripDetails'>
             <h4 class='row tripDetails'>
                <div class='col-sm-2 journey'>
                    <div class='driver'>$firstname
                    </div>
                    <div>
                        <img class='previewing' src='$picture' />
                    </div>
                </div>

                <div class='col-sm-8 journey'>
                    <div>
                        <span class='departure'>Departure:
                        </span> 
                        $tripDeparture.
                    </div>
                    <div>
                        <span class='destination'>Destination:
                        </span> 
                        $tripDestination.
                    </div>
                    <div class='time'>
                    $time
                    </div>
                     <div class='frequency'>
                        $frequency
                    </div>
                </div>

                <div class='col-sm-2  journey2'>
                    <div class='price'>
                    ₹ $tripPrice
                    </div>

                    <div class='perseat'>
                        Per Seat
                    </div>
                    <div class='seatsavailable'>
                        $seatsAvailable left
                    </div>
                </div>
            </h4>
            
            
            <div class='moreinfo' id='moreinfo'>
               Book Your trip 
                
            </div>";
     
            
            
           
          echo  "</div>";
             
        }
    }
}




echo "</div>";

  
    ?>

<style>
    #bookNow
    {
        background-color: black;
        padding: 3px 10px;
        width: 130px;
        height: 40px;
        margin-top: 5px;
        border: none;
    }
</style>
<html>
<div class="modal" id="bookingDetailsModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Congralutaion! Booking is Successfully placed
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--Login message from PHP file-->
                  <div id="bookmessage">
                   
                  </div>
                  <div id="serachResults1"></div>
                  <?php
                  function generateRandomID() {
                    $alphabets = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $digits = '0123456789';
                    $randomID = '';
                
                    for ($i = 0; $i < 2; $i++) {
                        $randomID .= $alphabets[rand(0, strlen($alphabets) - 1)];
                    }
                
                    for ($i = 0; $i < 4; $i++) {
                        $randomID .= $digits[rand(0, strlen($digits) - 1)];
                    }
                
                    return $randomID;
                }
            
                // Generate a random ID with the specified format
                $randomID = generateRandomID();
               
                

                  echo "<p>Hi <strong> " .$user.  " </strong></p> <p>Your Booking is Confirmed </p>Enjoy every moment of your journey.<p>Thank You</p>";
                  echo " <p> Traveling is not just about the places you go, but the people you go with. Share your adventures and multiply the joy</p>";
                  echo "<div class='alert alert-success'>Please Check your mail $email for booking details</div>"
                   
                  ?>
                  

                 
                  
                  
              </div>
              <div class="modal-footer">
                  
                <button type="button" id="OK" class="btn btn-default" data-dismiss="modal">
                  Ok
                </button>
                 
              </div>
          </div>
      </div>
      </div>
</html>
<script>
  

      
      $(document).ready(function() {
  $('#bookNow').click(function() {
    $("#spinner").show();
    $("#bookingDetailsModal").hide();
    // Call the PHP script to send the mail using AJAX
    $.ajax({
      url: 'send_email.php',
      method: 'POST',
      success: function(response) {
        $("#spinner").hide();
        $("#bookingDetailsModal").show();
        $("#bookingDetailsModal").slideDown();

        var modal = document.getElementById('bookingDetailsModal');
        var toggleModalBtn = document.getElementById('OK');

// Function to toggle the modal visibility
function toggleModal() {
  if (modal.style.display === 'none' || modal.style.display === '') {
    modal.style.display = 'block';

    // Automatically hide the modal after 3000 milliseconds (3 seconds)
    setTimeout(function() {
      modal.style.display = 'none';
    }, 3000);
  } else {
    modal.style.display = 'none';
  }
}
  toggleModalBtn.addEventListener('click', toggleModal);
       



       
        
        // alert(response); // Display the response from the PHP script
        console.log(response);
      },
      error: function(error) {
        console.log(error);
        $("#spinner").hide();
        
            
      }
    });
  });
});
   
</script>
   
    


























