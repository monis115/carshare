<?php

// <!--  The use is redircted to this file after clicking the activation link -->
session_start();
include('connection.php');

// <!-- Sign up links contains two GET parameters:email and activation key -->

// <!-- if email or activation key is missing the show error -->


           


   ?>      

   <!--20.contactform.php-->
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Form</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            h1{
                color:purple;   
            }
            .contactForm{
                border:1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }
        </style> 

    </head>
        <body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10 contactForm">
            <h1>Account Activation Link</h1>
<?php
if(!isset($_GET['email']) || !isset($_GET['key']))
{
    echo "<div class='alert alert-danger'>There was an error. Please click on the activation link you recieved in your email </div>";
    exit;
}


// <!-- else -->
//     <!-- store the in two variables -->
  $email=$_GET['email'];
  $key=$_GET['key'];
//     <!-- prepare variables for the query -->
$email=mysqli_escape_string($link,$email);
$key=mysqli_escape_string($link,$key);
//     <!-- Run Query:set activation field to "activated" for the provide email -->
$sql="UPDATE users SET activation='activated' WHERE (email='$email' AND activation='$key') LIMIT 1";
$result=mysqli_query($link,$sql);
//     <!-- if Query is successful,show success message and invite user to  log in -->
    if(mysqli_affected_rows($link)==1){
        echo "<div class='alert alert-success'>Congratulations ! Your account have been activated!</div>";
        echo "<a href='index.php' class='btn btn-lg btn-info' type='button'>Log in</a>";
    }else{
       // <!-- show error message -->
        echo "<div class='alert alert-danger'>Sorry !Your account could not be activated </div>";
    }

?>
          
        </div>
    </div>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        </body>
</html>
<?php ob_flush(); ?>  