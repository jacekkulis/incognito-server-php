
<?php
/**
This is waiter script for Raspberry Pi. This script waits for POST informaton from Raspberry that want do something - send image, send information etc.
 */

require "/storage/ssd5/051/3004051/public_html/IncognitoServer/vendor/autoload.php";
//require "../vendor/autoload.php";

$fp = fopen("myPost.txt", "wb", FILE_APPEND);

$response = array();
$response['error'] = false;
$response['message'] = "Default message";
$response['pictureUrl'] = "https://incognitodevs.000webhostapp.com/IncognitoServer/src/uploads/hehe.jpg";


if (empty($_POST['client']) || empty($_POST['request'])) {
    $response['error'] = true;
    $response['message'] = "Some value is not set";
    fwrite($fp, json_encode('Some value is not set'));
} else {
    $response['error'] = false;
    $response['message'] = "Everything set - processing request.";
    fwrite($fp, json_encode("Everything set - processing request."));
    fwrite($fp, json_encode($_POST));
}

$status = true;
$client = "";
$request = "";


if (isset($_POST['client']) && isset($_POST['request'])) {
    $client = $_POST['client'];
    $request = $_POST['request'];

    if (strcmp($client, "raspberry") == 0) {
        fwrite($fp, json_encode("raspberry"));
        if (strcmp($request, "image") == 0) {
            fwrite($fp, json_encode("REQUEST: image"));

            // get image from raspberry
            if ($_FILES["picture"]["error"] == 0) {
                $config = new incognito\Config\Configuration();
                $image_uploader = new \incognito\ImageUploader($_FILES['picture']);

                if ($image_uploader->isUploaded()) {

                    fwrite($fp, json_encode("file is uploaded"));

                    $response['error'] = false;
                    $response['message'] = "File is uploaded and url is sent to android.";

                    $androFile = fopen("android.txt", "wb");
                    fwrite($androFile, "https://incognitodevs.000webhostapp.com/IncognitoServer/src/uploads/" .$image_uploader->getTargetFile());
                    fclose($androFile);

                    $response['pictureUrl'] = "https://incognitodevs.000webhostapp.com/IncognitoServer/src/uploads/".$image_uploader->getTargetFile();

                    try {
                        $notification_sender = new \incognito\NotificationSender();
                        $response = $notification_sender->sendNotification('Obtained picture', $image_uploader->getTargetFile());

                        fwrite($fp, json_encode('Notification is sent successfully to topic: '.$response->getBody()->getContents()));
                    } catch (Exception $ex) {
                        $response['error'] = true;
                        $response['message'] = $ex->getMessage();
                        fwrite($fp, json_encode($ex->getMessage()));
                    }
                } else {
                    $response['error'] = true;
                    $response['message'] = $image_uploader->result;
                    fwrite($fp, json_encode($image_uploader->result));
                }

            } else {

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