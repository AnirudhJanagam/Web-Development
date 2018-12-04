<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if (isset($_POST["submit"]) && $_POST["submit"] != null) {
    $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image (or there was no file uploaded).";
        echo '<br><center>
        <form action="main.php" method="POST">
        <input type="hidden" name="idtoken" value="' . $_POST['idtoken'] . '" />
        <input type="submit" value="Try Another Image" required />
        </form></center>';
        $uploadOk = 0;
        die();
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file must be less than 5 MB.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo " Your file was not uploaded.";
    echo '<br><center>
	<form action="main.php" method="POST">
	<input type="hidden" name="idtoken" value="' . $_POST['idtoken'] . '" />
	<input type="submit" value="Try Another Image" required />
	</form></center>';
    die();
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file '" . basename($_FILES["fileToUpload"]["name"]) . "' has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

list($width_original, $height_original) = getimagesize($target_file);
checkImage();

// Prints out the correct size of the image
function checkImage() {
    global $width_original, $height_original;
    if ($width_original > 1024 && $height_original > 768) {
        $width = 1024;
        $height = 768;
        printImage($width, $height);
    } else if ($width_original > 1024 && $height_original <= 768) {
        $width = 1024;
        printImage($width, $height_original);
    } else if ($width_original <= 1024 && $height_original > 768) {
        $height = 768;
        printImage($width_original, $height);
    } else {
        printImage($width_original, $height_original);
    }
}

// Prints out the image
function printImage($width, $height) {
    global $width_original, $height_original, $target_file;

    echo "<center><font color=\"red\">Note: Some images are too large, so they get 
    truncated. Click on images to show full size, double click to restore to 
    original size!</font> <br><br><img src= \"$target_file\" alt=\"image\" 
    width=\"$width\" height=\"$height\" style=\"cursor:pointer;cursor:hand\" 
	onclick=\"this.src='$target_file'; this.height='$height_original'; 
	this.width='$width_original'\" ondblclick=\"this.src='$target_file';
	this.height='$height';this.width='$width'\" /></center>";
}
?>

<br>
<br>
<center><div style="display: inline-block">
<form action="image_filter.php" method="POST">
<input type="submit" name "grayscale" value="Grayscale" />
<input type="hidden" name="target_file" value="<?php echo $target_file ?>" />
<input type="hidden" name="image_file_type" value="<?php echo $imageFileType ?>" />
<input type="hidden" name="filename" value="<?php echo basename($_FILES["fileToUpload"]["name"]) ?>" />
<input type="hidden" name="grayscale" value="gray" />
</form></div>
<div style="display: inline-block">
<form action="image_filter.php" method="POST">
<input name "edgedetect" type="submit" id="submit" value="EdgeDetect" />
<input type="hidden" name="target_file" value="<?php echo $target_file ?>" />
<input type="hidden" name="image_file_type" value="<?php echo $imageFileType ?>" />
<input type="hidden" name="filename" value="<?php echo basename($_FILES["fileToUpload"]["name"]) ?>" />
<input type="hidden" name="edgedetect" value="edge" />
</form></div>
<div style="display: inline-block">
<form action="image_filter.php" method="POST">
<input name "emboss" type="submit" id="submit" value="EMBOSS" />
<input type="hidden" name="target_file" value="<?php echo $target_file ?>" />
<input type="hidden" name="image_file_type" value="<?php echo $imageFileType ?>" />
<input type="hidden" name="filename" value="<?php echo basename($_FILES["fileToUpload"]["name"]) ?>" />
<input type="hidden" name="emboss" value="emboss" />
</form></div>
<div style="display: inline-block">
<form action="image_filter.php" method="POST">
<input name "mean_removal" type="submit" id="submit" value="Mean Removal" />
<input type="hidden" name="target_file" value="<?php echo $target_file ?>" />
<input type="hidden" name="image_file_type" value="<?php echo $imageFileType ?>" />
<input type="hidden" name="filename" value="<?php echo basename($_FILES["fileToUpload"]["name"]) ?>" />
<input type="hidden" name="mean_removal" value="mean" />
</form></div>
<div style="display: inline-block">
<form action="image_filter.php" method="POST">
<input name "negate" type="submit" id="submit" value="Negate" />
<input type="hidden" name="target_file" value="<?php echo $target_file ?>" />
<input type="hidden" name="image_file_type" value="<?php echo $imageFileType ?>" />
<input type="hidden" name="filename" value="<?php echo basename($_FILES["fileToUpload"]["name"]) ?>" />
<input type="hidden" name="negate" value="negate" />
</form></div>
<div style="display: inline-block">
<form action="image_filter.php" method="POST">
<input name "sepia" type="submit" id="submit" value="Sepia" />
<input type="hidden" name="target_file" value="<?php echo $target_file ?>" />
<input type="hidden" name="image_file_type" value="<?php echo $imageFileType ?>" />
<input type="hidden" name="filename" value="<?php echo basename($_FILES["fileToUpload"]["name"]) ?>" />
<input type="hidden" name="sepia" value="sepia" />
</form></div>

<br><form action="main.php" method="POST">
<input type="submit" name="try_another_image" value="Try Another Image" />
<input type="hidden" name="target_file" value="<?php echo $target_file ?>" />
<input type="hidden" name="idtoken" value="<?php echo $_POST['idtoken'] ?>" />
</form></center>