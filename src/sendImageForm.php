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
require "/storage/ssd5/051/3004051/public_html/IncognitoServer/vendor/autoload.php";
//require "../vendor/autoload.php";

if (isset($_POST['submitImage'])){
    // image get - change true to false
    $raspFile = fopen("request.txt","wb");
    fwrite($raspFile, json_encode("true"));
    fclose($raspFile);
    echo 'Android wants image!';

    if (isset($_FILES['data'])){
        $config = new incognito\Config\Configuration();
        $image_uploader = new \incognito\ImageUploader($_FILES['data']);

        if ($image_uploader->isUploaded()){
            echo 'File uploaded';
            //echo $image_uploader->result;

            try {
                $notification_sender = new \incognito\NotificationSender();
                $response = $notification_sender->sendNotification('Obtained picture', $image_uploader->getTargetFile());
                echo 'Notification is sent successfully to topic: '.$response->getBody()->getContents();
            } catch (Exception $ex) {
                echo 'Error: ' .$ex->getMessage();
            }
        }
        else {
            echo 'Error, not uploaded.';
            echo $image_uploader->result;
        }

    }
    else {
        echo 'File not set';
    }

}
?>