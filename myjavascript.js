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
        console.log('Hello World');
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
       // FB.Auth.setAuthResponse(null, 'unknown');
        document.getElementById('fbLink').setAttribute("onclick","fbLogin()");
        document.getElementById('fbLink').innerHTML = '<img src="images/fb-login-btn.png"/>';
        document.getElementById('userData').innerHTML = '';
        document.getElementById('status').innerHTML = '<p>You have successfully logout from Facebook.</p>';
       
    });
    window.location.href='login.php'; 
}