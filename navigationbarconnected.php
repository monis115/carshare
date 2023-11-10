<?php

$user_id=$_SESSION['user_id'];
// get username
$sql="select * from users where user_id='$user_id'";
$result=mysqli_query($link,$sql);
$count=mysqli_num_rows($result);
if($count==1)
{
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $username=$row["username"];

}else
{
    echo "<div class='alert alert-danger'> There was an error retrieving  the username from database </div>";
}

?>





<
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
                <li class="active fa-solid fa-magnifying-glass"><a href="#"><img src="Image/searchIcon.png" alt="">Search</a></li>
                <li><a href="profile.php"><img src="Image/profile.png" alt="">Profile</a></li>
                <li><a href="#"><img src="Image/helpnav.png" alt="">Help</a></li>
                <li><a href="contactus.php"><img src="Image/contactus.png" alt="">Contact Us</a></li>
                <li><a href="mainPage.php"><img src="Image/trips.png" alt="">My Trips</a></li>

              </ul>
              <ul class="nav navbar-nav navbar-right" id="navigationBar">
                <li><a href="#"><?php  echo $username; ?> </a></li>
              
                <li><a href="index.php?logout=1"> <img src="Image/logout.png" alt="">Log out</a></li>

              </ul>
                

             </div>
        </div>

    </nav>