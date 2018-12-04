<center>
<form action="index.php" method="POST">
    <input type="text" name="search" value="<?php if (isset($_POST['search'])) { echo $_POST['search']; } else { echo ''; } ?>"/>
    <input type="submit" value="Search" required />
</form>
<?php
if ((isset($_POST['search'])) && ($_POST['search'] != null)) {
    echo '<img src="https://source.unsplash.com/random/800x600/?'.$_POST['search'].'" />';
} else {
    echo '<img src="https://source.unsplash.com/random/800x600/" />';
}
?>
<br> <font color="red">The images above are randomly changed everytime you refresh the browser. This is provided
    through the use of the  <i>unsplash</i> API. However, using the search bar above, you may search any term and you will 
    obtain relatively close image results.</font></center>

<html lang="en">
	<head>
		<meta name="google-signin-scope" content="profile email">
		<meta name="google-signin-client_id" content="879359105317-9pk1igs8lu221pddtnlr8j1ar5t2un2r.apps.googleusercontent.com">
		<script src="https://apis.google.com/js/platform.js" async defer></script>
	</head>
	<body>
		<center>
			<br>
			Once you have signed in with your Google credentials proceed by clicking 'Let's Go' button.
			<br>
			<br>
			<br>
			<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
			<script>
				function onSignIn(googleUser) {
					// Useful data for your client-side scripts:
					var profile = googleUser.getBasicProfile();
					console.log("ID: " + profile.getId());
					// Don't send this directly to your server!
					console.log("Name: " + profile.getName());
					console.log("Image URL: " + profile.getImageUrl());
					console.log("Email: " + profile.getEmail());

					// The ID token you need to pass to your backend:
					var id_token = googleUser.getAuthResponse().id_token;
					console.log("ID Token: " + id_token);

					var xhr = new XMLHttpRequest();
					xhr.open('POST', 'main.php');
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.onload = function() {
						console.log('Signed in as: ' + xhr.responseText);
					};
					xhr.send('idtoken=' + id_token);
					document.getElementById('idtoken').value = id_token;
				};
			</script>

			<br>
			<br>
			<form action="main.php" method="POST">
			    <input type="hidden" name="idtoken" id="idtoken" value="" />
				<input type="submit" value="Let's Go" required />
			</form>

			<a href="#" onclick="signOut();">Sign out from Google</a>
			<script>
				function signOut() {
					var auth2 = gapi.auth2.getAuthInstance();
					auth2.signOut().then(function() {
						console.log('User signed out.');
					});
				}
			</script>
		</center>
	</body>
</html>