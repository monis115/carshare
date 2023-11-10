<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}

include("connection.php");
$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
    $username = $row['username'];
    $email = $row['email']; 
    
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDO0djPN4MeE0hk7yjp_qadwUYuN8wUVM4&libraries=places"></script>


<link rel="stylesheet" href="style1.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


<link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
<link rel="icon" type="image/gif" href="Image/Drivery-logos_white.png">
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500);
*:focus {
  outline: none;
}
#container{
        margin: 150px;
    }
#notePad,  #done,#allnotes, .delete{
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
    .notehead
    {
        border: 1px solid wheat;
        border-radius: 5px;
        margin-bottom: 10px;
        cursor: pointer;
        padding: 2px 10px 2px  10px;
         background-color: #000000;
background-image: linear-gradient(147deg, #000000 0%, #434343 74%);;
    }
    .notetext
    {
        font-size: 20px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .notetime
    {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;

    }
    .preview
    {
        height: 20px;
        border-radius: 50%;
    }
    #plus
    {
        border-radius: 50%;
    }
    #googleMap
      {
        width: 100%;
        height: 30vh;
        /* margin-top: 5px; */
        margin-bottom: 10px;
      }
      .modal{
              z-index: 12;
      }
      .modal-backdrop{
        z-index: 10;
      }

      .trip
      {
        margin: 10px;
        padding: 10px;
        background-color: #FBFBFB;
        border-radius: 2px
      }
      .departure, .destination
      {
        font-size: 1.5em;
        font-weight: bold;
      }
      .modal-body,.modal-footer,.modal-header
      {
        background-color: black;
        
      }
      .modal-header
      {
        color: whitesmoke;
      }
      label
      {
        color: whitesmoke;
      }
      #time,#time2
      {
        margin-top: 10px;
      }



#login-box {
  position: relative;
  margin: 5% auto;
  width: 1000px;
  height: 400px;
  background: whitesmoke;
  border-radius: 3px;
  /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); */
  box-shadow: 1px -9px 21px -3px rgba(255,255,255,0.46);
-webkit-box-shadow: 1px -9px 21px -3px rgba(255,255,255,0.46);
-moz-box-shadow: 1px -9px 21px -3px rgba(255,255,255,0.46);
  text-align: center;
  left: -130px;
  top:-10px;
}

.left {
  position: absolute;
  top: 0;
  left: 0;
  box-sizing: border-box;
  /* padding: 40px; */
  width: 200px;
  height: 400px;
  text-align: center;
 
}


.or {
  position: absolute;
  top: 180px;
  left: 479px;
  width: 45px;
  height: 45px;
  background: #DDD;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  line-height: 40px;
  color: black;
  
}



.right .loginwith {
  display: block;
  /* margin-bottom: 40px; */
  font-size: 28px;
  color: #FFF;
  text-align: center;
}

#myContainer
      {
        margin-top: 60px;
        text-align: center;
        color: white;
        
      }
      h1{
        font-size: 4em;
      }
      .bold
      {
        font-weight: bold;
        
      }
      input{
        outline: none;
        color: black;
        text-align: center;
        
        
      }
    
      .signup
      {
        margin-top: 20px;
        background-color: black;
        color: whitesmoke;
        width: 200px;
      }
      
      .input1{
        /* padding: 10px; */
        width: 100%;
        padding-bottom: 10px;
        margin-left: 80px;
        
      }
      .input2
      {
        width: 290px;
        padding: 7px;
        height: 40px;
        border-radius: 5px;
        background-color: rgb(238,238,238);
        border: none;
        box-shadow: 0 4px 8px 0 rgba(232, 230, 230, 0.2), 0 6px 20px 0 rgba(155, 155, 155, 0.898);

      }
     
      .h3
      {
        margin-top: 20px;
        color: black;
        margin-bottom: 13px;
        font-weight: bold;
        text-align: center;
        left: 120px;
        position: relative;
      }
    
     
      .white
      {
        color: whitesmoke;
      }
     
      .btn-lg :hover
      {
        background-color: antiquewhite;
        color: black;
      }
      .request
      {
        border: none;
        background-color: whitesmoke;
      }
      /*  Request Button Animation */
      @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap');

#request{
    display: flex;
    justify-content: center;
    align-items: center;
    align-items: center;
    
    
    font-family: 'Raleway', sans-serif;
    font-weight: bold;
}
.requestButton{
    position: relative;
    display: inline-block;
    padding: 10px 15px;
    /* margin: 0px 0; */
    width: 150px;
    margin-left: 40px;
    color: #03e9f4;
    text-decoration: none;
    text-transform: uppercase;
    transition: 0.5s;
    letter-spacing: 4px;
    overflow: hidden;
    left: 20px;
    /* margin-right: 50px; */
   
}
.requestButton:hover{
    background: whitesmoke;
    color: black;
    box-shadow: 10px -4px 48px -7px rgba(30,27,27,0.77);
-webkit-box-shadow: 10px -4px 48px -7px rgba(30,27,27,0.77);
-moz-box-shadow: 10px -4px 48px -7px rgba(30,27,27,0.77);
}
.requestButton:nth-child(1){
    filter: hue-rotate(270deg);
}
.requestButton:nth-child(2){
    filter: hue-rotate(110deg);
}
.requestButton span{
    position: absolute;
    display: block;
}
.requestButton span:nth-child(1){
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg,transparent,#000000);
    animation: animate1 1s linear infinite;
}
@keyframes animate1{
    0%{
        left: -100%;
    }
    50%,100%{
        left: 100%;
    }
}
.requestButton span:nth-child(2){
    top: -100%;
    right: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg,transparent,#000000);
    animation: animate2 1s linear infinite;
    animation-delay: 0.25s;
}
@keyframes animate2{
    0%{
        top: -100%;
    }
    50%,100%{
        top: 100%;
    }
}
.requestButton span:nth-child(3){
    bottom: 0;
    right: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(270deg,transparent,#000000);
    animation: animate3 1s linear infinite;
    animation-delay: 0.50s;
}
@keyframes animate3{
    0%{
        right: -100%;
    }
    50%,100%{
        right: 100%;
    }
}


.requestButton span:nth-child(4){
    bottom: -100%;
    left: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(360deg,transparent,#000000);
    animation: animate4 1s linear infinite;
    animation-delay: 0.75s;
}
@keyframes animate4{
    0%{
        bottom: -100%;
    }
    50%,100%{
        bottom: 100%;
    }
}
#brandLogo
{
  height: 100px;
  width: 100px;
  /* margin-top: 0px;
  margin-left: 0px; */
  position: relative;
  top: -10px;
  left :-10px;
  border-radius: 50%;
  /* border: 2px solid white; */
  box-shadow: 6px 24px 48px -13px rgba(255,255,255,0.75);
-webkit-box-shadow: 6px 24px 48px -13px rgba(255,255,255,0.75);
-moz-box-shadow: 6px 24px 48px -13px rgba(255,255,255,0.75);
}
#matters
{
  position: relative;
  align-items: center;
  /* left: 80px; */
}
#addtripModal,#edit
{
  padding-top: 50px;
}
#addtripModalDown
{
  padding-top: 270px;
}


      




      
      
</style>

   

    <title>Car Share</title>
</head>
<body>
<!--  -->
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
              <li class=""><a href="index.php"><img src="Image/searchIcon.png" alt="">Search</a></li>
                <li ><a href="profile.php"> <img src="Image/profile.png" alt="">Profile</a></li>
                <li><a href="#"> <img src="Image/helpnav.png" alt="">Help</a></li>
                <li><a href="contactus.php"> <img src="Image/contactus.png" alt="">Contact Us</a></li>
                <li class="a"><a href="mainPage.php"> <img src="Image/trips.png" alt="">My Trips</a></li>

              </ul>
              <ul class="nav navbar-nav navbar-right">
         
              <li><a href="#" data-toggle="modal"><?php echo $_SESSION["username"] ?></a></li>
              <li><a href="index.php?logout=1"><img src="Image/logout.png" alt=""> Log out</a></li>
                

              </ul>
                

             </div>
        </div>

    </nav>
      <div class="container" id="container">
        <div class="row">

          <div class="col-sm-8 col-sm-offset-2">
           <div>
             <button type="button" class="btn btn-lg" id="plus" data-toggle="modal" data-backdrop="false" data-target="#addtripModal">
                +

            </button>
            
           </div>
           <div id="myTrips" class="trips">
                    <!--  ajax call php file -->
           </div>

          </div>

        </div>

      </div>

      <!-- add Trip -->
          
    <form method="post" id="addtripform">
        <div class="modal" id="addtripModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Add New Trip
                  </h4>
              </div>
              <div class="modal-body" id="addtripModalDown">
                  
                  <!--Sign up message from PHP file-->
                  <div id="addtripmessage"></div>
                  <div id="googleMap"></div>

                  
                  <div class="form-group">
                      <label for="departure" class="sr-only">Departure:</label>
                      <input class="form-control" type="text" name="departure" id="departure" placeholder="Departure" >
                  </div>
                  <div class="form-group">
                      <label for="destination" class="sr-only">Destination:</label>
                      <input class="form-control" type="text" name="destination" id="destination" placeholder="Destination" >
                  </div>
                  <div class="form-group">
                      <label for="price" class="sr-only">Price:</label>
                      <input class="form-control" type="number" name="price" id="price" placeholder="Fare" >
                  </div>
                  <div class="form-group">
                      <label for="seatsavailable" class="sr-only">Seatsavailable:</label>
                      <input class="form-control" type="number" name="seatsavailable" id="seatsavailable" placeholder="Seats Available" >
                  </div>
                  <div class="form-group">
                    <label for="">
                        <input type="radio" name="regular" id="yes" value="Y">
                        Regular
                        </label>
                        <label>
                        <input type="radio" name="regular" id="no" value="N">
                        One-Off
                        </label>
                   
                  </div>
                  <div class="checkbox checkbox-inline regular">
                    <label > <input type="checkbox" name="monday" id="monday" value="1">Monday</label>
                    <label > <input type="checkbox" name="tuesday" id="tuesday" value="1">Tuesday</label>
                    <label > <input type="checkbox" name="wednesday" id="wednesday" value="1">Wednesday</label>
                    <label > <input type="checkbox" name="thrusday" id="thrusday" value="1">Thrusday</label>
                    <label > <input type="checkbox" name="friday" id="friday" value="1">Friday</label>
                    <label > <input type="checkbox" name="saturday" id="saturday" value="1">Saturday</label>
                    <label > <input type="checkbox" name="sunday" id="sunday" value="1">Sunday</label>

                  </div>
                  <div class="form-group one-off">
                      <label for="date" class="sr-only">Date:</label>
                      <input class="form-control" readonly="readonly" name="date" id="date" >
                  </div>
                  <div class="form-group regular one-off">
                      <label for="time" class="sr-only">Time:</label>
                      <input class="form-control" type="time" name="time" id="time" >
                  </div>
                
              </div>
              <div class="modal-footer">
                  <input class="btn btn-primary" name="createtrip" type="submit" value="Create Trip">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button>
              </div>
          </div>
      </div>
      </div>
      </form>


      <!-- Edit Trip -->
      <form method="post" id="edittripform">
        <div class="modal" id="edittripModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Edit Trip
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--Edit Trip  message from PHP file-->
                  <div id="edittripmessage"></div>
                  

                  
                  <div class="form-group">
                      <label for="departure2" class="sr-only">Departure:</label>
                      <input class="form-control" type="text" name="departure2" id="departure2" placeholder="Departure" >
                  </div>
                  <div class="form-group">
                      <label for="destination2" class="sr-only">Destination:</label>
                      <input class="form-control" type="text" name="destination2" id="destination2" placeholder="Destination" >
                  </div>
                  <div class="form-group">
                      <label for="price2" class="sr-only">Price:</label>
                      <input class="form-control" type="number" name="price2" id="price2" placeholder="Fare" >
                  </div>
                  <div class="form-group">
                      <label for="seatsavailable2" class="sr-only">Seatsavailable:</label>
                      <input class="form-control" type="number" name="seatsavailable2" id="seatsavailable2" placeholder="Seats Available" >
                  </div>
                  <div class="form-group">
                    <label for="">
                        <input type="radio" name="regular2" id="yes2" value="Y">
                        Regular
                        </label>
                        <label>
                        <input type="radio" name="regular2" id="no2" value="N">
                        One-Off
                        </label>
                   
                  </div>
                  <div class="checkbox checkbox-inline regular2">
                    <label > <input type="checkbox" name="monday2" id="monday2" value="1">Monday</label>
                    <label > <input type="checkbox" name="tuesday2" id="tuesday2" value="1">Tuesday</label>
                    <label > <input type="checkbox" name="wednesday2" id="wednesday2" value="1">Wednesday</label>
                    <label > <input type="checkbox" name="thrusday2" id="thrusday2" value="1">Thrusday</label>
                    <label > <input type="checkbox" name="friday2" id="friday2" value="1">Friday</label>
                    <label > <input type="checkbox" name="saturday2" id="saturday2" value="1">Saturday</label>
                    <label > <input type="checkbox" name="sunday2" id="sunday2" value="1">Sunday</label>

                  </div>
                  <div class="form-group one-off2">
                      <label for="date2" class="sr-only">Date:</label>
                      <input class="form-control" readonly="readonly" name="date2" id="date2" >
                  </div>
                  <div class="form-group regular2 one-off2">
                      <label for="time2" class="sr-only">Time:</label>
                      <input class="form-control" type="time" name="time2" id="time2" >
                  </div>
                
              </div>
              <div class="modal-footer">
                  <input class="btn btn-primary" name="updatetrip" type="submit" value="Update">
                  <input class="btn btn-danger" name="deletetrip"  id="deletetrip" value="Delete" type="button">
                  
                 
                   <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button>
              </div>
          </div>
      </div>
      </div>
      </form>


      <div id="safety" class="container-fluid">
             <!-- Create header -->
     <div class="jumbotron container-fluid">
        <div class="container-fluid" id="matters">
        
            <h2> <i class="fa fa-shield" aria-hidden="true"></i> Your Safety Matters</h2>
        </div>

     </div>

     <!-- create icons with text -->
     <div class="icon">
        <div class="container">
            <div class="row" >
                 <div class="col-md-4 viewport">
                  <img src="Image/safety.png" alt="" class="bodyimage">
                  <h2>Safety features</h2>
                  <p>Tell your loved ones where you are. Get help with the tap of a button. Technology makes travel safer than ever before</p>
                 </div>
                 <div class="col-md-4 viewport">
                  <img src="Image/communities.png" alt="" class="bodyimage">
                  <h2>An inclusive community</h2>
                  <p>We are millions of riders and drivers who share Community Guidelines and depend on one another to do the right thing.</p>
                 </div>
                 <div class="col-md-4 viewport">
                  <img src="Image/help.png" alt="" class="bodyimage">
                  <h2>Help if you need it</h2>
                  <p>Get 24/7 support in the app for any questions or safety concerns you might have.</p>
                 </div>
            </div>

        </div>

     </div>

      </div>
                   <!--  box 3 -->
                   <div class='parent'>
        <div class='child' id="child">
            <h2>There is one rdie 4 everyone</h2>
            <p>Now more than ever, reservations are a way of life. Reserve a premium ride experience, up to 90 days in advance, for whenever you’re ready to ride.</p>
        </div>
        <div class='child'><img src="Image/travel.jpg" alt="" width="600" height="500"></div>
      </div>
       <!--  box5 -->
       <div id="box5">
   <h3 style="color: #FFF;" class="">Customer Reviews</h3>
  <div class="content-wrapper">
  
    <div class="news-card">
      <a href="#" class="news-card__card-link"></a>
      <img src="Image/customer1.jpg" alt="" class="news-card__image">
      <div class="news-card__text-wrapper">
        <h2 class="news-card__title">Not Good Experience</h2>
        <div class="news-card__post-date">Jan 29, 2020</div>
        <div class="news-card__details-wrapper">
          <p class="news-card__excerpt">I scheduled a ride days in advance for a pickup at a certain time. When the time came I was told it would be 55 minutes before he arrived. If I didn’t have my own car to drive I would have missed my flight.&hellip;</p>
         
        </div>
      </div>
    </div>
  
    <div class="news-card">
      <a href="#" class="news-card__card-link"></a>
      <img src="Image/customer2.jpg" alt="" class="news-card__image">
      <div class="news-card__text-wrapper">
        <h2 class="news-card__title">Amazing</h2>
        <div class="news-card__post-date">Jan 29, 2023</div>
        <div class="news-card__details-wrapper">
          <p class="news-card__excerpt">We recently took a ride to our hotel from the Las Vegas airport on October 1, 2023. Rovie was our driver. He made our trip so fun. He was friendly and entertaining. &hellip;</p>
          
        </div>
      </div>
    </div>
  
    <div class="news-card">
      <a href="#" class="news-card__card-link"></a>
      <img src="Image/customer3.jpg" alt="" class="news-card__image">
      <div class="news-card__text-wrapper">
        <h2 class="news-card__title">Nice</h2>
        <div class="news-card__post-date">Feb 21, 2021</div>
        <div class="news-card__details-wrapper">
          <p class="news-card__excerpt">I been riding this ride for a little while now but my last Uber has been the best. Kayla with a blue Ford car in Baytown, Texas was excellent. She was there a few mins earlier and she got me to my appointment an hour away fast. &hellip;</p>
          
        </div>
      </div>
    </div>
  
    <div class="news-card">
      <a href="#" class="news-card__card-link"></a>
      <img src="Image/customer4.jpg" alt="" class="news-card__image">
      <div class="news-card__text-wrapper">
        <h2 class="news-card__title">It was Good</h2>
        <div class="news-card__post-date">Jan 29, 2018</div>
        <div class="news-card__details-wrapper">
          <p class="news-card__excerpt">I have used this ride 4 times and never again. Three were horrible experiences and they make it almost impossible to contact Customer Service and when I asked the lady via e-mail to call me and gave her my number because I have a tear in my shoulder, she would not respond</p>
          
        </div>
      </div>
    </div>
  
    <div class="news-card">
      <a href="#" class="news-card__card-link"></a>
      <img src="Image/customer5.jpg" alt="" class="news-card__image">
      <div class="news-card__text-wrapper">
        <h2 class="news-card__title">Four *</h2>
        <div class="news-card__post-date">Jan 29, 2018</div>
        <div class="news-card__details-wrapper">
          <p class="news-card__excerpt">Thrifty way to get from place to place at a fair price. Clean vehicles and drivers. Unlike taxis, they don’t take you “for a ride” to make more money! Their routes are provided via telephone navigation&hellip;</p>
         
        </div>
      </div>
    </div>
  
    <div class="news-card">
      <a href="#" class="news-card__card-link"></a>
      <img src="Image/customer6.jpg" alt="" class="news-card__image">
      <div class="news-card__text-wrapper">
        <h2 class="news-card__title">Positive </h2>
        <div class="news-card__post-date">Jan 29, 2018</div>
        <div class="news-card__details-wrapper">
          <p class="news-card__excerpt">My complaint turned out to be incorrect, and I am very sorry for that. I had been fixed, and it was nothing that Uber had did. I was handled fast. I have to give them a top rating for helping me to fix the issue. </p>
          
        </div>
      </div>
    </div>
  
  </div>
      
</div>

  


    


     
    <div id="spinner">
      
    <div id="spinner1">
   
   </div> <div id="spinner1"></div>
    </div>
    <div id="box7">

    <div id=box11>
     
     <h1>WE BELIVE IN ACTION </h1>
 <h3>Car Sharing: Driving Towards Sustainability</h3>
 
 <div class="wrapper" id="wrapper2">
     <div class="counter col_fourth">
       <i class="fa fa-user fa-2x"></i>
       <h2 class="timer count-title count-number" data-to="178461" data-speed="1500"></h2>
        <p class="count-text ">Happy Customers</p>
     </div>
 
     <div class="counter col_fourth">
       <i class="fa fa-car fa-2x"></i>
       <h2 class="timer count-title count-number" data-to="11489" data-speed="1500"></h2>
       <p class="count-text ">Register Cab Owner</p>
     </div>
 
     <div class="counter col_fourth">
       <i class="fa fa-star fa-2x"></i>
       <h2 class="timer count-title count-number" data-to="1378" data-speed="1500"></h2>
       <p class="count-text ">Valuable Reviews</p>
     </div>
 
     <div class="counter col_fourth end">
       <i class="fa fa-thumbs-up fa-2x"></i>
       <h2 class="timer count-title count-number" data-to="3452" data-speed="1500"></h2>
       <p class="count-text ">Daily Services</p>
     </div>
 </div>
     <footer class="footer-section">
    <div class="container">
        <div class="footer-cta pt-5 pb-5">
            <div class="row">
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="cta-text">
                            <h4>Find us</h4>
                            <span>1010 Avenue, Salt Lake 700101, Kolkata</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="fas fa-phone"></i>
                        <div class="cta-text">
                            <h4>Call us</h4>
                            <span>1800101444</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-30">
                    <div class="single-cta">
                        <i class="far fa-envelope-open"></i>
                        <div class="cta-text">
                            <h4>Mail us</h4>
                            <span>drivesmart@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-content pt-5 pb-5">
            <div class="row">
                <div class="col-xl-4 col-lg-4 mb-50">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html"><img src="Image/brandLogo.png" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="footer-text">
                            <p>Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do eiusmod tempor incididuntut consec tetur adipisicing
                            elit,Lorem ipsum dolor sit amet.</p>
                        </div>
                        <div class="footer-social-icon">
                            <span>Follow us</span>
                            <a href="#"><i class="fab fa-facebook-f facebook-bg"></i></a>
                            <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                            <a href="#"><i class="fab fa-google-plus-g google-bg"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Useful Links</h3>
                        </div>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">about</a></li>
                            <li><a href="#">services</a></li>
                            <li><a href="#">portfolio</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Expert Team</a></li>
                            <li><a href="#">Contact us</a></li>
                            <li><a href="#">Latest News</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-50">
                    <div class="footer-widget">
                        <div class="footer-widget-heading">
                            <h3>Subscribe</h3>
                        </div>
                        <div class="footer-text mb-25">
                            <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                        </div>
                        <div class="subscribe-form">
                            <form action="#">
                                <input type="text" placeholder="Email Address">
                                <button><i class="fab fa-telegram-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                    <div class="copyright-text">
                        <!-- <p>Copyright &copy; 2018, All Right Reserved <a href="https://codepen.io/anupkumar92/">Anup</a></p> -->
                        <p> drivesmart.com Copyright &copy 2020-<?php  $today=date("Y"); echo $today ?>  <a href="https://github.com/monis115">Monis</a></</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Policy</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

     </div>

     
     <script src="map.js"></script>
    <script src="mytrips.js"></script>
</body>
</html>