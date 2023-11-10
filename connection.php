<?php
$user="root";
$pass="";
$host="localhost";
$dbname="carshare";
$link=mysqli_connect($host,$user,$pass,$dbname) or die("unable to connect ".mysqli_connect_error());
if(mysqli_connect_error())
   die("Error:Unable to connect ".mysqli_connect_error());




?>