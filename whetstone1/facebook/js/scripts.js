window.fbAsyncInit = function() {
	FB.init({
		appId      : '233665653420678', // App ID
		channelUrl : '//mywhetstone.org/channel.php', // Channel File
		status     : true, // check login status
		cookie     : true, // enable cookies to allow the server to access the session
		xfbml      : true,  // parse XFBML
		frictionlessRequests : true
	});
	// Additional initialization code here
	
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			// the user is logged in and has authenticated your
			// app, and response.authResponse supplies
			// the user's ID, a valid access token, a signed
			// request, and the time the access token 
			// and signed request each expire
			$(".loggedin").css('display','block');
			$(".loggedoff").css('display','none');
			var uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
		} else if (response.status === 'not_authorized') {
			// the user is logged in to Facebook, 
			// but has not authenticated your app
			FB.login();
		} else {
			// the user isn't logged in to Facebook.
			//window.top.location = 'https://www.facebook.com/index.php';
		}
	});
};

// Load the SDK Asynchronously
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement('script'); js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";
	ref.parentNode.insertBefore(js, ref);
}(document));

function login(){
	FB.login(function(response){
		$(".loggedin").css('display','block');
		$(".loggedoff").css('display','none');
	});
}