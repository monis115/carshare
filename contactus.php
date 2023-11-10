<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');

$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $username = $row['username'];
    $email = $row['email']; 
    $picture=$row['profilepicture'];
    $firstname=$row['first_name'];
    $lastname=$row['last_name'];
    $gender=$row['gender'];
    $address=$row['moreinformation'];
    $phonenumber=$row['phonenumber'];
}else{
    echo "There was an error retrieving the username and email from the database";   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="style.scss" class="scss">


<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&display=swap" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO0djPN4MeE0hk7yjp_qadwUYuN8wUVM4&libraries=places"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://kit.fontawesome.com/f9a0ab92b5.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8e2bd9acb0.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="icon" type="image/gif" href="Image/Drivery-logos_white.png">
<link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
<style>
    #container{
        margin: 150px;
    }
#notePad,  #done,#allnotes{
        display: none;
    }
    .buttons
    {
        margin-bottom: 20px;
    }
    textarea{
        width: 100%;
        max-width: 100%;
        font-size: 16px;
        line-height: 1.7em;
        border-left: 20px solid #00ff00;
        outline: none;
        padding: 10px;
         background-color: black;
         color:wheat;
         border-bottom: 2px solid #00ff00;
         border-right: 2px solid #00ff00;
         border-top: 2px solid #00ff00;
    }
    
   tr{
    background-color: black;
    color: wheat;
   }
   .table:not(.table-sticky) {
    box-shadow: 10px 10px 5px black;
}
.table {
    border-collapse: collapse;
}


.table > tbody > tr > td, .table> thead > tr> th {
    padding: 6px;
    border: 1px solid black;
    text-align: left;
}
.table>thead:first-child>tr:first-child>th {
    border-top: 0;
    background: black;
}
.preview
{
    height: 25px;
    border-radius: 50%;
}
.preview2
{
    height: auto;
    max-height:350px;
    border-radius: 50%;
    
}
#profileImage a
{
    height: 100%;
    position: relative;
    top: -3px;
}
 #profileImage b
{
    height: 100%;
    position: relative;
    top: -15px;
}





</style>

   

    <title>Drivery | Connect</title>
</head>
<body>
    <nav role="navigation" class="navbar-fixed-top">

<div class="container-fluid" id="navigationBar">       
<div  role="navigation" id="" class="navbar navbar-fixed-top">
     <div class="navbar-header">
        <a class="navbar-brand" href="#navbarCollapse"><img id="brandLogo" src="Image/brandLogo.png" alt=""></a>
        <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
     </div>
     <div class="navbar-collapse collapse" id="navbarCollapse navigationBar">
     <ul class="nav navbar-nav">
                <li><a href="index.php"><img src="Image/searchIcon.png" alt=""> Search</a></li>
                <li><a href="#"> <img src="Image/profile.png" alt=""> Profile</a></li>
                <li><a href="#" > <img src="Image/helpnav.png" alt="">Help</a></li>
                <li><a href="#"><img src="Image/contactus.png" alt="">Contact Us</a></li>
                <li class=""><a href="mainPage.php"><img src="Image/trips.png" alt=""> My Trips</a></li>

              </ul>
              <ul class="nav navbar-nav navbar-right">
               
              <li id="profileImage"><a href="#" data-toggle="modal"> <b>  <a href="#updatepicture"  data-toggle="modal"  data-target="#updatepicture"   data-backdrop="false">
                    <?php


                     if(empty($picture))
                     {
                         echo "<img class='preview' src='profile/empty.png' alt='This is Profle Picture'>";
                     }else
                     {
                        echo "<img class='preview' src='$picture' alt='This is Profle Picture'>";
                     }
                     ?>
                </a><?php echo $username ?></b></a></li>
              <li><a href="index.php?logout=1"> <img src="Image/logout.png" alt=""> Log out</a></li>
                

              </ul>
                

             </div>
        </div>

    </nav>
    <section id="contact">
					<div class="content">
						<div id="form">
              <div id="contactMessage"></div>
							<form action="" id="contactForm" method="post">
								<span>Name</span>
								<input type="text" name="name" class="name" placeholder="Enter your name" require tabindex=1 />
								<span>Email</span>
								<input type="text" name="email" class="email" placeholder="Enter your email" require tabindex=2 />
								<span id="captcha"></span>
								
								<textarea class="message" name="message" placeholder="Enter your message"  require tabindex=4></textarea>
								<input type="submit" name="submit" value="Send e-mail" class="submit" tabindex=5>
							</form>
						</div>
			</section>
            <div id="spinner">
    <div id="spinner1">
   
   </div> <div id="spinner1"></div>
    </div>
<script>
   // Ajax Call for the sign up form
// once the form is submitted 
$("#contactForm").submit(function(event){ 
    $("#spinner").show();
    $("#contactMessage").hide();
    
   
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    //send them to signup.php using AJAX
    $.ajax({
        url: "contact.php",
        type: "POST",
        data: datatopost,
        success: function(data){ // AJAX call successful:show error or success message
            if(data){
              $("#contactMessage").html(data);
              $("#spinner").hide();
                // $('#loginmessage').html(data);   
                $("#contactMessage").slideDown();

                // window.alert("Message has been sent Successfully");
            }
        },
        error: function(){ // AJAX call fails:show ajax call error
            // windowa.alert("Error!404");
          $("#contactMessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");
            
        }
    
    });

});
</script>
   
     
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

     <script src="js/bootstrap.min.js"></script>
     
</body>
</html>