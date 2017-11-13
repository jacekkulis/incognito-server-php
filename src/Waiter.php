<!DOCTYPE html>
<html>
<body>

Waiting for info from Andro or rasp... </ br>

<form method="post" enctype="multipart/form-data">
    Select image to upload: </br>

    <input type="number" name="id" id="id"></br>
    <input type="text" name="client" id="client"></br>
    <input type="text" name="request" id="request"></br>

    <input type="file" name="data" id="fileToUpload"></br>
    <input type="submit" value="Upload Image" name="submitImage">
</form>

</body>
</html>

<?php
/**
This is waiter script for Raspberry Pi. This script waits for POST informaton from Raspberry that want do something - send image, send information etc.
 */

require "/storage/ssd5/051/3004051/public_html/IncognitoServer/vendor/autoload.php";
//require "../vendor/autoload.php";

if (isset( $_POST['id']) && isset($_POST['client']) && isset($_POST['request'])) {

}
else {
    var_dump($_POST);
    print_r(json_encode($_POST));
    $fp = fopen("myPost.txt","wb");
    fwrite($fp, json_encode($_POST));
    fclose($fp);
    echo 'Var POST is not set!.';
}

$status = true;
$client = "";
$request = "";

if (isset( $_POST['id']) && isset($_POST['client']) && isset($_POST['request'])){
    $client = $_POST['client'];
    $request = $_POST['request'];
    $fp = fopen("myPost.txt","wb");

    if (strcmp($client, "android") == 0){
        fwrite($fp, json_encode("android"));
        if (strcmp($request, "camera") == 0){

            //send request to raspberry
            // File that contains info if raspberry wants image or not.
            $raspFile = fopen("request.txt","wb");
            fwrite($raspFile, json_encode("true"));
            fclose($raspFile);

            fwrite($fp, json_encode("camera"));

        }
    }

    if (strcmp($client, "raspberry") == 0) {
        fwrite($fp, json_encode("raspberry"));

        if (strcmp($request, "image") == 0){
            // get image from raspberry
            if (isset($_FILES['data'])){
                $config = new incognito\Config\Configuration();
                $image_uploader = new \incognito\ImageUploader($_FILES['data']);

                if ($image_uploader->isUploaded()){
                    echo 'File uploaded';

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

            // image get - change true to false
            $raspFile = fopen("request.txt","wb");
            fwrite($raspFile, json_encode("false"));
            fclose($raspFile);


//            $notification_sender = new \incognito\NotificationSender();
//            $notification_sender->sendNotification('Obtained picture', 'sample file');
//            echo '<div>'.'Notification should be sent'.'</div>';

        }
    }



    fclose($fp);
}

?>