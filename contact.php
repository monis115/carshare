<?php
$errors="";

//<!--Check user inputs-->
//    <!--Define error messages-->
$missingUsername = '<p><strong>Please enter a username!</strong></p>';
 $missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';

$missingPhonenumber= '<p><strong>Please Enter Phone Number</strong></p>';
$missingMessage= '<p><strong>Please Enter Message</strong></p>';
$invalidPhonenumber= '<p><strong>Please Enter a valid Phone Number (Digits only and less than 15 long )</strong></p>';
//    <!--Get username, email, password, password2-->
//Get username
if(empty($_POST["name"])){
    $errors .= $missingUsername;
}else{
    $username = filter_var($_POST["name"], FILTER_SANITIZE_STRING);   
}
//Get firstname

//Get lastname
if(empty($_POST["message"])){
    $errors .= $missingMessage;
}else{
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);   
}
//Get email
if(empty($_POST["email"])){
    $errors .= $missingEmail;   
}else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;   
    }
}
if($errors){
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}
  $to="monisraza2009@gmail.com";
  $message=$message;

  $subject="Drivery Complain";
  $header="mail from $email";
  if(mail($to,$subject,$message,$header)){
       echo "<div class='alert alert-info'> Message has been sent successfully </div> ";
  }else{
    echo "<div class='alert alert-danger'> Server is busy try after sometime </div> ";
  }  
  $to=$email;
  $message="Thank you for bringing this matter to our attention. We sincerely apologize for any inconvenience or frustration you may have experienced, and we appreciate the opportunity to address your concerns.
  
  We take customer feedback seriously, and your input helps us improve our products/services and customer experience. Please allow us to investigate the issue thoroughly so that we can provide you with a comprehensive resolution.
  
  Our team is committed to ensuring your satisfaction, and we will do everything in our power to resolve this issue promptly. We value your business and want to make sure you have a positive experience with our company.

  Thank you for your patience and understanding.
  

  !!!!DRIVERY!!!
  ";
  $subject="Response From Drivery";
  $header="Dear $username";
  if(mail($to,$subject,$message,$header)){
       
  }else{
       
  }  


?>