<?php
session_start();

if (isset($_POST['idtoken']) && ($_POST['idtoken']) != null) {
    $_SESSION['username'] = 'user';
    if (isset($_SESSION['username'])) {
        echo 'Welcome, ' . $_SESSION['username'];

        if (isset($_POST["try_another_image"])) {
            foreach (glob('uploads/*') as $file) {
                if (basename($file) != '.gitignore.txt')
                    unlink($file);
                // empties uploads folder after use
            }
        }
    }
} else {
    echo 'Please ensure you\'re authenticated with Google to view this page.';
    die();
}
?>

<br>
<br>
<form action="upload.php" method="post" enctype="multipart/form-data">
	Select an image to upload:
	<input type="hidden" name="idtoken" value="<?php echo $_POST['idtoken'] ?>" />
	<input type="file" name="fileToUpload" id="fileToUpload">
	<input type="submit" value="Upload Image" name="submit">
</form>

<?php echo "<br><center><a href='weather.php?idtoken=$_POST[idtoken]'>Check out today's weather!</a></center>"; ?>

<br>
<br>
<br>
<form action="logout.php" method="POST">
	<input type="submit" value="Logout" required />
</form>