<?php

session_start(); 
//print_r($_SESSION);
$host = "localhost";
$port = "5432";
$dbname = "creativez_register";
$user = "creativez_mona";
$password = "Testing@345"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";

$dbconn = pg_connect($connection_string);
echo $_POST['username'];
if($_POST['username'] != ""){
    
    $hashpassword = $_POST['pwd'];
    $link_address = "Home.php";
    $sql ="select *from public.users where email = '".pg_escape_string($_POST['username'])."' and password ='".$hashpassword."'";
    $data = pg_query($dbconn,$sql); 
    $login_check = pg_num_rows($data);
    echo $login_check;
    if($login_check > 0){ 
        
        echo "<script>window.location.href='Home.php';</script>";  
     
    }else{
        
        echo "Invalid Details";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CreativeZCreationZ Login</title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

/* style the container */
.container {
  position: right;
  border-radius: 5px;
  background-color: white;
  padding: 20px 0 30px 0;
} 

/* style inputs and link buttons */
input,
.btn {
  width: 100%;
  padding: 12px;
  border: line;
  border-radius: 10px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}

input:hover,
.btn:hover {
  opacity: 1;
}

/* add appropriate colors to fb, twitter and google buttons */
.facebook {
  background-color: #3b5998;
  color: white;
}

.twitter {
  background-color: #55ACEE;
  color: white;
}

.google {
  background-color: #dd4b39;
  color: white;
}

/* style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

/* Two-column layout */
.col {
  float: center;
  width: 50%;
  margin: auto;
  padding: 0 10px;
  margin-top: 6px;
}
.col2 {
  float: left;
  width: 50%;
  margin: auto;
  padding: 0 10px;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}


/* bottom container */
.bottom-container {
  text-align: center;
  background-color: #666;
  border-radius: 0px 0px 4px 4px;
}

/* Responsive layout - when the screen is less than 650px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 650px) {
  .col {
    width: 100%;
    margin-top: 0;
  }
  }
 
}
</style>
</head>
<body>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="myjavascript.js"></script>
    
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '136233495071754',
      cookie     : true,
      xfbml      : true,
      version    : 'v10.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   
   function fbLogin() {
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            
            getFbUserData();
        } else {
            document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
        }
    }, {scope: 'email'});
}

// Fetch the user profile data from facebook
function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
    function (response) {
        
        $.ajax({
        url: "register.php?mode=fb",
        type: "post",
        data: response ,
        success: function (response) {

         window.location.href='Home.php';

           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
        
        document.getElementById('fbLink').setAttribute("onclick","fbLogout()");
        document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
        
        document.getElementById('status').innerHTML = '<p>Thanks for logging in, ' + response.first_name + '!</p>';
        
    });
}

// Logout from facebook
function fbLogout() {
    FB.logout(function() {
        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
        document.getElementById('fbLink').innerHTML = '<img src="images/fb-login-btn.png"/>';
        document.getElementById('userData').innerHTML = '';
        document.getElementById('status').innerHTML = '<p>You have successfully logout from Facebook.</p>';
    });
}

</script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0&appId=883643429104783&autoLogAppEvents=1" nonce="5BpTgt8z"></script>




    
<div class="container">
    <div class="row">
  <h2 style="text-align:center">CreativeZ_CreationZ</h2>
  <form action="" method="post">
      
      
      <div class="col">
        <div class="hide-md-lg">
          <h2 style="text-align:center">Signin manually</h2>
        </div>
  
     
    <div class="form-group">
      <label for="username">Email Address:</label>
      <input type="username" class="form-control" id="username" placeholder="Enter email" name="username">
    </div>
    
     
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    <div class="bottom-container">
  
    <div class="col2">
      <a href="https://creativezcreationz.com/register.php" style="color:white" class="btn btn-primary">Sign up</a>
    </div>
    <div class="col2">
      <a href="https://creativezcreationz.com/Forgot.html" style="color:white" class="btn btn-primary">Forgot password?</a>
   
     <div class="vl">
        <span class="vl-innertext"></span>
      </div>
     
  </div>
   
</div>



<div class="hide-md-lg">
          <h2 style="text-align:center">Or Signin with</h2>
        </div>
      <div class="form-group">
        <!-- Display login status -->
<div id="status"></div>

<!-- Facebook login or logout button -->
        <a href="javascript:void(0);" onclick="fbLogin();" id="fbLink" class="facebook btn">
          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
        </a>


<!-- Display user's profile info -->
<div class="ac-data" id="userData"></div>

        <a href="https://creativezcreationz.com/Twitter.html" class="twitter btn">
          <i class="fa fa-twitter fa-fw"></i> Login with Twitter
        </a>
        <a href="https://creativezcreationz.com/Google.html" class="google btn"><i class="fa fa-google fa-fw">
          </i> Login with Gmail
        </a>
      </div>
  </form>
</div>
</body>
</html>
