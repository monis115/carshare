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

   

    <title>Profile</title>
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
   <div id="box13">
  <aside class="profile-card">
    <header>
      <a> <?php echo "<img class='' src='$picture' alt='This is Profle Picture'>" ?>  </a>
      <h1><?php echo $firstname ?></h1>
      <h2> <?php echo $username   ?></p></h2>
    </header>
    <div class="profile-bio">
      <p>You can call me Raza. I'm a Indian <strong> Web Developer ,Software Developer</strong>. Making some cool things with coffee and code.</p>
      <p>Bug-free code is a myth, but software engineers are the myth busters.</p>
      <ul class="social-icons list-unstyled ">
        <li><a href=""><i class="fa fa-envelope"></i><?php echo $email ?></a></li>
        <!-- <li><a href=""><i class="fa fa-codepen"></i>https://codepen.io/monis115</a></li>
        <li><a href=""><i class="fa fa-github"></i> https://github.com/monis115</a></li> -->
        <!-- <li><a href=""><i class="fa fa-twitter"></i></a></li> -->
      </ul>
    </div>
  </aside>
 </div>
    <!--  update username  -->
    <form method="post" id="updateusernameForm">
        <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h3 id="myModalLAbel">Edit Username </h3>
                     </div>
                     <div class="modal-body">
                        <div id="loginmessage">

                        </div>
                     <div class="form-group">
                          <input type="text" name="username" id="username" class="form-control" value="usernamevalue">

                      </div>
                  
                      
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         <button type="button" class="btn green">Update</button>

                    </div>

                </div>

            </div>  
            
        </div>
        </form>


    

    <!--   Update  emial -->
    <form method="post" id="updateemialForm">
        <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h3 id="myModalLAbel">Edit Email Address </h3>
                     </div>
                     <div class="modal-body">
                        <div id="loginmessage">

                        </div>
                     <div class="form-group">
                          <input type="email" name="email" id="useremial" class="form-control" value="Email Value">

                      </div>
                  
                      
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         <button type="button" class="btn green">Update</button>

                    </div>

                </div>

            </div>  
            
        </div>
        </form>
       

    <!-- Update Password-->

    <form method="post" id="updatepassworddForm">
        <div class="modal" id="updatepassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h3 id="myModalLAbel">Enter current  & New Passowrd </h3>
                     </div>
                     <div class="modal-body">
                        <div id="loginmessage">

                        </div>
                     <div class="form-group">
                          <input type="password" name="currentpassowrd" id="currentpassowrd" class="form-control" placeholder="Your Current Password">

                      </div>
                     <div class="form-group">
                          <input type="password" name="password" id="passowrd" class="form-control" placeholder="Choose a Password">

                      </div>
                     <div class="form-group">
                          <input type="password" name="passowrd2" id="passowrd2" class="form-control" placeholder="Re-Enter the Password">

                      </div>
                  
                      
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         <button type="button" class="btn green">Update</button>

                    </div>

                </div>

            </div>  
            
        </div>
        </form>
        <!-- update profile -->

        <form method="post" enctype="multipart/form-data" id="updatepictureform">
        <div class="modal" id="updatepicture" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Upload Picture:
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--Update picture message from PHP file-->
                  <div id="updatepicturemessage"></div>
               
    
                   

                    <?php

                  
                     if(empty($picture))
                     {
                         echo " <div>
                             <img class='preview2' id='preview2' src='profile/empty.png' alt='This is a profile Picture'>
                         </div>";
                     }else
                     {
                        echo " <div>
                        <img class='preview2' id='preview2' src='$picture' alt='This is a Profile Picture'>
                         </div>";
                     }

                   ?>
                  <div class="form-inline">
                      <div class="form-group">
                        <label for="picture">Select a picture:</label>
                        <input type="file" name="picture" id="picture">
                      </div>
                </div>

                  
                  
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="updatepicture" type="submit" value="Submit">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button> 
              </div>
          </div>
      </div>
      </div>
      </form>

    

    <!-- footer -->

   
     
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

     <script src="js/bootstrap.min.js"></script>
     <script src="profile.js"></script>
</body>
</html>