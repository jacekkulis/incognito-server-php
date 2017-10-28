<!DOCTYPE html>
<html>
<body>

<form method="post" enctype="multipart/form-data">
    Select image to upload: </br>
    <input type="file" name="data" id="fileToUpload"></br>
    <input type="submit" value="Upload Image" name="submitImage">
</form>

</body>
</html>

<?php
require "../vendor/autoload.php";
if (isset($_POST['submitImage'])){
    if (isset($_FILES['data'])){
        $config = new incognito\Config\Configuration();
        $image_uploader = new \incognito\ImageUploader($_FILES['data']);
        echo $image_uploader->result;
        }
    else {
        echo 'File not set';
    }

}
?>