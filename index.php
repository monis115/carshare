<?php
// connection
session_start();
include('connection.php');
// log out
include('logout.php');

// rememberme 
include('remember.php');


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
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


<link rel="icon" type="image/gif" href="Image/Drivery-logos_white.png">
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
  <title>SmartDirve</title>
<style>
 

      
    </style>
</head>
<body>
<?php
if(isset($_SESSION["user_id"])){
  include("navigationbarconnected.php");

}else
{
   include("navigationbarnotconnected.php");
}



?>

<div class="container-fluid" id="myContainer">
   <div class="row mainbox">
       <div class="col-md-6 col-md-offset-3">
        <h1>Plan Your Next Trip Now! </h1>
          <p class="lead white">Save Money ! Save Environment</p>
          <p class="bold white">You can save upto 3000INR in a year using car sharing</p>
             <!-- Search Form -->
             <form  class="form-inline" method="get" id="searchForm">
                 <!-- <div class="form-group">
                  <label for="departure" class="sr-only"> Departure :</label>
                  <input type="text" placeholder="Departure" name="departure" id="departure">

                 </div>
                 <div class="form-group">
                  <label for="destination" class="sr-only"> Destination :</label>
                  <input type="text" placeholder="Destination" name="destination" id="destination">

                 </div>
                 <input type="submit" value="Search" class="btn btn-lg green" name="search"> -->
                 <div id="login-box">
                 <div class="left">
                 <div class="form-group input1">
                 <img src="Image/car1.png" alt="" id="logo" width="70px" height="70">
                 </div>
                   
                   <h3 class="h3">Request a Ride</h3>
                 <div class="form-group input1">
                  <label for="departure" class="sr-only"> </label>
                  <input type="text" placeholder="Departure" name="departure"  class="input2" id="departure">

                 </div>
                 <div class="form-group input1">
                  <label for="destination" class="sr-only"> </label>
                  <input type="text" placeholder="Destination" name="destination" class="input2" id="destination">

                 </div>
                 <div class="form-group input1">
                 <!-- <input type="submit" value="Request" class="btn btn-default btn-lg request" name="search"> -->
         
<div id="request">
       <a href="#" class="requestButton">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <input type="submit" value="Request" class=" request" name="search">
    </a>
</div>
                 </div>
                 <div class="form-group input1">
                 <?php
                if(!isset($_SESSION["user_id"])){
                  echo "<button class='btn btn-lg  signup' data-toggle='modal' data-target='#signupModal' data-backdrop='false'>Register</button>";
                 }

                 ?>

                 </div>

                 
                

                 
                 </div>
                 
  
  <div id="googleMap">
  </div>
  <div class="or">-></div>
  
</div>
             </form>
             

             
             <div id="searchResults"></div>
            
              
            
             

       </div>

   </div>
</div>

    <!--  log in  -->
    <form method="post" id="loginform">
        <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Login: 
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--Login message from PHP file-->
                  <div id="loginmessage"></div>
                  

                  <div class="form-group">
                      <label for="loginemail" class="sr-only">Email:</label>
                      <input class="form-control" type="email" name="loginemail" id="loginemail" placeholder="Email" maxlength="50">
                  </div>
                  <div class="form-group">
                      <label for="loginpassword" class="sr-only">Password</label>
                      <input class="form-control" type="password" name="loginpassword" id="loginpassword" placeholder="Password" maxlength="30">
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="rememberme" id="rememberme">
                        Remember me
                      </label>
                          <a class="pull-right" style="cursor: pointer" data-backdrop="false"  data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">
                      Forgot Password?
                      </a>
                  </div>
                  
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="login" type="submit" value="Login">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="signupModal" data-toggle="modal">
                  Register
                </button>  
              </div>
          </div>
      </div>
      </div>

      </form>

      <!-- booking Details Modal -->
      <div class="modal" id="bookingDetailsModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Your Booking Details: 
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--Login message from PHP file-->
                  <div id="loginmessage">
                    <?php

                      
                    ?>
                  </div>
                  

                 
                  
                  
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="login" type="submit" value="Login">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Ok
                </button>
                 
              </div>
          </div>
      </div>
      </div>
    

    <!--   sign up -->
    <form method="post" id="signupform">
        <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Sign up today and Start using our car sharing service!
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--Sign up message from PHP file-->
                  <div id="signupmessage"></div>
                  
                  <div class="form-group">
                      <label for="username" class="sr-only">Username:</label>
                      <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
                  </div>
                  <div class="form-group">
                      <label for="firstname" class="sr-only">firstname:</label>
                      <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Firstname" maxlength="30">
                  </div>
                  <div class="form-group">
                      <label for="lastname" class="sr-only">lastname:</label>
                      <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Lastname" maxlength="30">
                  </div>
                  <div class="form-group">
                      <label for="email" class="sr-only">Email:</label>
                      <input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
                  </div>
                  <div class="form-group">
                      <label for="password" class="sr-only">Choose a password:</label>
                      <input class="form-control" type="password" name="password" id="password" placeholder="Choose a password" maxlength="30">
                  </div>
                  <div class="form-group">
                      <label for="password2" class="sr-only">Confirm password</label>
                      <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
                  </div>
                  <div class="form-group">
                      <label for="phonenumber" class="sr-only">Telephone</label>
                      <input class="form-control" type="number" name="phonenumber" id="phonenumber" placeholder="Phone Number" maxlength="30">
                  </div>
                  <div class="form-group">
                   <label for=""><input type="radio" name="gender" id="male" value="male">Male</label>
                   <label for=""><input type="radio" name="gender" id="female" value="female">female</label>
                  </div>
                  <div class="form-group">
                      <label for="moreinformation">Address</label>
                      <textarea name="moreinformation" id="moreinformation" class="form-control" rows="5" maxlength="300"></textarea>


                  </div>
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="signup" type="submit" value="Sign up">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button>
              </div>
          </div>
      </div>
      </div>
      </form>

    <!-- forgot pass -->
    <!-- <form method="post" id="forgotpasswordForm">
        <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <h3 id="myModalLAbel">Forgot Password ? Enter your email Address </h3>
                     </div>
                     <div class="modal-body">
                        <div id="forgotpassowordmessage">

                        </div>
                     <div class="form-group">
                          <input type="email" name="forgotpassemail" id="forgotpassemail" class="form-control" placeholder="Email Address">

                      </div>
                   
                     
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         <button type="button" class="btn green">Submit</button>
                         <button type="button" class="btn btn-default pull-left" data-target="#signupModal" data-toggle="modal">Register</button>
                    </div>

                </div>

            </div>  
            
        </div>
        </form> -->
        <form method="post" id="forgotpasswordform">
        <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">
                    &times;
                  </button>
                  <h4 id="myModalLabel">
                    Forgot Password? Enter your email address: 
                  </h4>
              </div>
              <div class="modal-body">
                  
                  <!--forgot password message from PHP file-->
                  <div id="forgotpasswordmessage"></div>
                  

                  <div class="form-group">
                      <label for="forgotemail" class="sr-only">Email:</label>
                      <input class="form-control" type="email" name="forgotpassemail" id="forgotpassemail" placeholder="Email" maxlength="50">
                  </div>
              </div>
              <div class="modal-footer">
                  <input class="btn green" name="forgotpassword" type="submit" value="Submit">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Cancel
                </button>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="signupModal" data-toggle="modal">
                  Register
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

      <!--  Why we are the BEST -->

      <div id="whyus">
        <section id="Hover_con">
	<h2 style="text-align:center"> <i class="fa fa-bolt" aria-hidden="true"></i> Why we are the <strong> BEST </strong>!</h2>
   <img src="Image/carpool.png" alt="" id="carpool">
	<div class="container" id="container11">
		<div class="row">
			<div class="hover_content_block col-sm-4" style="background-image: url(http://freehtml5.co/demos/elate/images/img_7.jpg);">
				<div class="overlay-darker"></div>
				<div class="overlay"></div>
				<div class="Hover_con_text">
        <i class="fa fa-inr" aria-hidden="true"></i>

					<h2>Buget Friendly</h2>
					<p>Request a ride at any time and on any day of the year..</p>
					<p><a href="#" class="btn btn-primary">Readmore...</a></p>
				</div>
			</div>
			<div class="hover_content_block col-sm-4" style="background-image: url(http://freehtml5.co/demos/elate/images/img_8.jpg);">
				<div class="overlay-darker"></div>
				<div class="overlay"></div>
				<div class="Hover_con_text">
        <i class="fa fa-clock-o" aria-hidden="true"></i>
					<h2>Plan</h2>
					<p>Compare prices on every kind of ride, from daily commutes to special evenings out.</p>
					<p><a href="#" class="btn btn-primary">Readmore...</a></p>
				</div>
			</div>
			<div class="hover_content_block col-sm-4" style="background-image: url(http://freehtml5.co/demos/elate/images/img_10.jpg);">
				<div class="overlay-darker"></div>
				<div class="overlay"></div>
				<div class="Hover_con_text">
					<i class="fa fa-location-arrow" aria-hidden="true"></i>
					<h2>Easy way to get around</h2>
					<p>Tap and let your driver take you where you want to go.</p>
					<p><a href="#" class="btn btn-primary">Readmore...</a></p>
				</div>
			</div>
		</div>
	</div>
</section>

      </div>
      
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

<!--  Belive in Action -->

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



    <!-- footer -->

     <div id="box7">
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
     

    <!--  spinner -->

    <div id="spinner">
    <div id="spinner1">
   
   </div> <div id="spinner1"></div>
    </div>
     
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

     <script src="js/bootstrap.min.js"></script>
     
     <script src="map.js"></script>
     <script src="index.js"></script>
     <script>
      $(document).ready(function() {
    $("#news-slider").owlCarousel({
        items : 3,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        navigation:true,
        navigationText:["",""],
        pagination:true,
        autoPlay:true
    });
});
(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};
		
		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);
			
			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;
			
			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};
			
			$self.data('countTo', data);
			
			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);
			
			// initialize the element with the starting value
			render(value);
			
			function updateTimer() {
				value += increment;
				loopCount++;
				
				render(value);
				
				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}
				
				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;
					
					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}
			
			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};
	
	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};
	
	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
	formatter: function (value, options) {
	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
	}
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
});
class StickyNavigation {
	
	constructor() {
		this.currentId = null;
		this.currentTab = null;
		this.tabContainerHeight = 70;
		let self = this;
		$('.et-hero-tab').click(function() { 
			self.onTabClick(event, $(this)); 
		});
		$(window).scroll(() => { this.onScroll(); });
		$(window).resize(() => { this.onResize(); });
	}
	
	onTabClick(event, element) {
		event.preventDefault();
		let scrollTop = $(element.attr('href')).offset().top - this.tabContainerHeight + 1;
		$('html, body').animate({ scrollTop: scrollTop }, 600);
	}
	
	onScroll() {
		this.checkTabContainerPosition();
    this.findCurrentTabSelector();
	}
	
	onResize() {
		if(this.currentId) {
			this.setSliderCss();
		}
	}
	
	checkTabContainerPosition() {
		let offset = $('.et-hero-tabs').offset().top + $('.et-hero-tabs').height() - this.tabContainerHeight;
		if($(window).scrollTop() > offset) {
			$('.et-hero-tabs-container').addClass('et-hero-tabs-container--top');
		} 
		else {
			$('.et-hero-tabs-container').removeClass('et-hero-tabs-container--top');
		}
	}
	
	findCurrentTabSelector(element) {
		let newCurrentId;
		let newCurrentTab;
		let self = this;
		$('.et-hero-tab').each(function() {
			let id = $(this).attr('href');
			let offsetTop = $(id).offset().top - self.tabContainerHeight;
			let offsetBottom = $(id).offset().top + $(id).height() - self.tabContainerHeight;
			if($(window).scrollTop() > offsetTop && $(window).scrollTop() < offsetBottom) {
				newCurrentId = id;
				newCurrentTab = $(this);
			}
		});
		if(this.currentId != newCurrentId || this.currentId === null) {
			this.currentId = newCurrentId;
			this.currentTab = newCurrentTab;
			this.setSliderCss();
		}
	}
	
	setSliderCss() {
		let width = 0;
		let left = 0;
		if(this.currentTab) {
			width = this.currentTab.css('width');
			left = this.currentTab.offset().left;
		}
		$('.et-hero-tab-slider').css('width', width);
		$('.et-hero-tab-slider').css('left', left);
	}
	
}

new StickyNavigation();
$("#bookButton").click(function(){
        window.alert("You have SuccesFully Booked Your Journet Owner Will Contcat You Soon !");
    })



     </script>
     <!-- <script src="box4.js"></script> -->
  
</body>
</html>