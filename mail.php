<?php
//the subjec
$to="monisraza2021@gmail.com";
$subject="Regarding the SDE position";
$message="Hi This is Shyam";
$header="From :Code with Monis";
if(mail($to,$subject,$message,$header))
    echo "Email Sent Successfully";
?>