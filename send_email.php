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



   echo "<p>Hi <strong> " .$user.  " </strong></p> <p>Your Booking is " . $randomID ."</p>Enjoy every moment of your journey.<p>Thank Yoou </p>";
  $message="Hi $user  We have Confirmed you BOOKING Booking ID $randomID Travel safely and enjoy your time away... !!Thank You";

    // Retrieve form data
    $to = $email;
    $subject = "Booking Confrmation";
    $header="From SmartDrive";
    

    // Send the email
    if (mail($to, $subject, $message,$header)) {
        echo "Email sent successfully!";
    } else {
        echo "Email sending failed.";
    }

?>
