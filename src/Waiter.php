
<?php
/**
This is waiter script for Raspberry Pi. This script waits for POST informaton from Raspberry that want do something - send image, send information etc.
 */

require "/storage/ssd5/051/3004051/public_html/IncognitoServer/vendor/autoload.php";
//require "../vendor/autoload.php";

$fp = fopen("myPost.txt", "wb", FILE_APPEND);

if (empty($_POST['client']) || empty($_POST['request'])) {
    echo 'Some value is not set';
    fwrite($fp, json_encode('Some value is not set'));
} else {
    echo "Everything set - processing request.";
    fwrite($fp, json_encode("Everything set - processing request."));
    fwrite($fp, json_encode($_POST));
}

$status = true;
$client = "";
$request = "";

if (isset($_POST['client']) && isset($_POST['request'])) {
    $client = $_POST['client'];
    $request = $_POST['request'];

    if (strcmp($client, "android") == 0) {
        fwrite($fp, json_encode("android"));
        if (strcmp($request, "camera") == 0) {
            fwrite($fp, json_encode("REQUEST: camera"));
            //send request to raspberry
            // File that contains info if raspberry wants image or not.
            $raspFile = fopen("request.txt", "wb");
            fwrite($raspFile, json_encode("true"));
            fclose($raspFile);
            fwrite($fp, json_encode("camera"));
        }
    }

    if (strcmp($client, "raspberry") == 0) {
        fwrite($fp, json_encode("raspberry"));
        if (strcmp($request, "image") == 0) {
            fwrite($fp, json_encode("REQUEST: image"));

            // get image from raspberry
            if ($_FILES["picture"]["error"] == 0) {
                $config = new incognito\Config\Configuration();
                $image_uploader = new \incognito\ImageUploader($_FILES['picture']);

                if ($image_uploader->isUploaded()) {
                    echo 'File uploaded';
                    fwrite($fp, json_encode("file is uploaded"));
                    try {
                        $notification_sender = new \incognito\NotificationSender();
                        $response = $notification_sender->sendNotification('Obtained picture', $image_uploader->getTargetFile());
                        echo "</br>".'Notification is sent successfully to topic: '.$response->getBody()->getContents();

                    } catch (Exception $ex) {
                        echo "</br>".'Error: ' .$ex->getMessage();
                    }
                } else {
                    echo "</br>".'Error, not uploaded.';
                    echo "</br>".$image_uploader->result;
                    fwrite($fp, json_encode($image_uploader->result));
                }

            } else {
                echo "</br>".'File not set';
                fwrite($fp, json_encode('File not set'));
            }

            // image get - change true to false
            $raspFile = fopen("request.txt", "wb");
            fwrite($raspFile, json_encode("false"));
            fclose($raspFile);
        }
    }
}

fclose($fp);
?>