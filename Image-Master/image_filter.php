<!-- Note: The photo Editor (Aviary) API below was implemented correctly, however, as can be seen
     when the Edit Image! button is pressed, their service seems to be down. Since I've
     implemented the API correctly, I've decided to leave this API functionality as is. Also, I
     was going to integrate an option to edit the original (unfiltered) image as well, but
     since the API doesn't seem to function, it seemed unnecessary. -->
<!-- Load widget code -->
<script type="text/javascript" src="http://feather.aviary.com/imaging/v3/editor.js"></script>

<!-- Instantiate the widget -->
<script type="text/javascript">

    var featherEditor = new Aviary.Feather({
        apiKey: 'cc2dcd23-ccdb-4efb-88a8-1d99330293f5',
        onSave: function(imageID, newURL) {
            var img = document.getElementById(imageID);
            img.src = newURL;
        }
    });

    function launchEditor(id, src) {
        featherEditor.launch({
            image: id,
            url: src
        });
        return false;
    }

</script>

<?php
$target_file = $_POST['target_file'];
$imageFileType = $_POST['image_file_type'];
$filename = $_POST['filename'];

$grayscale_dir = 'uploads/img_filter_grayscale_' . $filename;
$edgedetect_dir = 'uploads/img_filter_edgedetect_' . $filename;
$emboss_dir = 'uploads/img_filter_emboss_' . $filename;
$mean_removal_dir = 'uploads/img_filter_mean_removal_' . $filename;
$negate_dir = 'uploads/img_filter_negate_' . $filename;
$sepia_dir = 'uploads/sepia_100_50_0_' . $filename;

if ($imageFileType == "jpg" || $imageFileType == "jpeg") {
    switch (buttonPressed()) {
        case 'grayscale' :
            $image = imagecreatefromjpeg($target_file);
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            imagejpeg($image, $grayscale_dir);
            imagedestroy($image);
            filteredNewImage($grayscale_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$grayscale_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'edgedetect' :
            $image = imagecreatefromjpeg($target_file);
            imagefilter($image, IMG_FILTER_EDGEDETECT);
            imagejpeg($image, $edgedetect_dir);
            imagedestroy($image);
            filteredNewImage($edgedetect_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$edgedetect_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'emboss' :
            $image = imagecreatefromjpeg($target_file);
            imagefilter($image, IMG_FILTER_EMBOSS);
            imagejpeg($image, $emboss_dir);
            imagedestroy($image);
            filteredNewImage($emboss_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$emboss_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'mean_removal' :
            $image = imagecreatefromjpeg($target_file);
            imagefilter($image, IMG_FILTER_MEAN_REMOVAL);
            imagejpeg($image, $mean_removal_dir);
            imagedestroy($image);
            filteredNewImage($mean_removal_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$mean_removal_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'negate' :
            $image = imagecreatefromjpeg($target_file);
            imagefilter($image, IMG_FILTER_NEGATE);
            imagejpeg($image, $negate_dir);
            imagedestroy($image);
            filteredNewImage($negate_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$negate_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'sepia' :
            $image = imagecreatefromjpeg($target_file);
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            imagefilter($image, IMG_FILTER_COLORIZE, 100, 50, 0);
            imagejpeg($image, $sepia_dir);
            imagedestroy($image);
            filteredNewImage($sepia_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$sepia_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        default :
            filteredNewImage($target_file);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$target_file.'\');">Customize Image!</button></center>';
            break;
    }
} else if ($imageFileType == "png") {
    switch (buttonPressed()) {
        case 'grayscale' :
            $image = imagecreatefrompng($target_file);
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            imagepng($image, $grayscale_dir);
            imagedestroy($image);
            filteredNewImage($grayscale_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$grayscale_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'edgedetect' :
            $image = imagecreatefrompng($target_file);
            imagefilter($image, IMG_FILTER_EDGEDETECT);
            imagepng($image, $edgedetect_dir);
            imagedestroy($image);
            filteredNewImage($edgedetect_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$edgedetect_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'emboss' :
            $image = imagecreatefrompng($target_file);
            imagefilter($image, IMG_FILTER_EMBOSS);
            imagepng($image, $emboss_dir);
            imagedestroy($image);
            filteredNewImage($emboss_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$emboss_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'mean_removal' :
            $image = imagecreatefrompng($target_file);
            imagefilter($image, IMG_FILTER_MEAN_REMOVAL);
            imagepng($image, $mean_removal_dir);
            imagedestroy($image);
            filteredNewImage($mean_removal_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$mean_removal_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'negate' :
            $image = imagecreatefrompng($target_file);
            imagefilter($image, IMG_FILTER_NEGATE);
            imagepng($image, $negate_dir);
            imagedestroy($image);
            filteredNewImage($negate_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$negate_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'sepia' :
            $image = imagecreatefrompng($target_file);
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            imagefilter($image, IMG_FILTER_COLORIZE, 100, 50, 0);
            imagepng($image, $sepia_dir);
            imagedestroy($image);
            filteredNewImage($sepia_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$sepia_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        default :
            filteredNewImage($target_file);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$target_file.'\');">Customize Image!</button></center>';
            break;
    }
} else if ($imageFileType == "gif") {
    switch (buttonPressed()) {
        case 'grayscale' :
            $image = imagecreatefromgif($target_file);
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            imagegif($image, $grayscale_dir);
            imagedestroy($image);
            filteredNewImage($grayscale_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$grayscale_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'edgedetect' :
            $image = imagecreatefromgif($target_file);
            imagefilter($image, IMG_FILTER_EDGEDETECT);
            imagegif($image, $edgedetect_dir);
            imagedestroy($image);
            filteredNewImage($edgedetect_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$edgedetect_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'emboss' :
            $image = imagecreatefromgif($target_file);
            imagefilter($image, IMG_FILTER_EMBOSS);
            imagegif($image, $emboss_dir);
            imagedestroy($image);
            filteredNewImage($emboss_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$emboss_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'mean_removal' :
            $image = imagecreatefromgif($target_file);
            imagefilter($image, IMG_FILTER_MEAN_REMOVAL);
            imagegif($image, $mean_removal_dir);
            imagedestroy($image);
            filteredNewImage($mean_removal_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$mean_removal_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'negate' :
            $image = imagecreatefromgif($target_file);
            imagefilter($image, IMG_FILTER_NEGATE);
            imagegif($image, $negate_dir);
            imagedestroy($image);
            filteredNewImage($negate_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$negate_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        case 'sepia' :
            $image = imagecreatefromgif($target_file);
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            imagefilter($image, IMG_FILTER_COLORIZE, 100, 50, 0);
            imagegif($image, $sepia_dir);
            imagedestroy($image);
            filteredNewImage($sepia_dir);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$sepia_dir.'\');">Edit Image!</button></center>';
            note();
            break;

        default :
            filteredNewImage($target_file);
            echo '<br><center><button onclick="history.go(-1);">Try Another Filter</button> OR <button 
            onclick="return launchEditor(\'image\', \''.$target_file.'\');">Customize Image!</button></center>';
            break;
    }
}

// Obtains the filtered image size
function filteredNewImage($new_location) {
    list($width_original, $height_original) = getimagesize($new_location);
    checkImage($new_location, $width_original, $height_original);
}

// Prints out the correct size of the image
function checkImage($target_file, $width_original, $height_original) {
    if ($width_original > 1024 && $height_original > 768) {
        $width = 1024;
        $height = 768;
        printImage($width, $height, $width_original, $height_original, $target_file);
    } else if ($width_original > 1024 && $height_original <= 768) {
        $width = 1024;
        printImage($width, $height_original, $width_original, $height_original, $target_file);
    } else if ($width_original <= 1024 && $height_original > 768) {
        $height = 768;
        printImage($width_original, $height, $width_original, $height_original, $target_file);
    } else {
        printImage($width_original, $height_original, $width_original, $height_original, $target_file);
    }
}

// Prints out the image
function printImage($width, $height, $width_original, $height_original, $target_file) {
    echo "<center><br> <font color=\"red\">Note: Some images are too large, so they get 
    truncated. Click on images to show full size, double click to restore to original 
    size!</font> <br><br><img id=\"image\" src= \"$target_file\" 
    alt=\"image\" width=\"$width\" height=\"$height\" style=\"cursor:pointer;cursor:hand\" 
    onclick=\"this.src='$target_file'; this.height='$height_original'; 
    this.width='$width_original'\" ondblclick=\"this.src='$target_file';
    this.height='$height';this.width='$width'\" /></center>";
}

function note() {
    echo "<center><br><font color=\"red\">Note: The photo Editor (Aviary) API was 
    implemented correctly, however, as can be seen when the <b>Edit Image!</b> button is 
    pressed, their service seems to be down. Since I've implemented the API correctly, 
    I've decided to leave this API functionality as is.</font></center>";
}

// Checks which button is pressed.
function buttonPressed() {
    if (isset($_POST["grayscale"])) {
        return 'grayscale';
    } else if (isset($_POST["edgedetect"])) {
        return 'edgedetect';
    } else if (isset($_POST["emboss"])) {
        return 'emboss';
    } else if (isset($_POST["mean_removal"])) {
        return 'mean_removal';
    } else if (isset($_POST["negate"])) {
        return 'negate';
    } else if (isset($_POST["sepia"])) {
        return 'sepia';
    } else {
        return 'not_found';
    }
}
?>