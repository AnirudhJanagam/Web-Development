<?php
session_start();
session_destroy();
header( "refresh:5;url=index.php" );
?>

<center><h3><b>Success!</b></h3>
<br>You are being redirected back to the login page.</center>