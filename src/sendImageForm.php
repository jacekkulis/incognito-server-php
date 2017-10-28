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

        if ($image_uploader->isUploaded()){
            echo 'File uploaded';
            echo $image_uploader->result;

            // send fcm with url
            $config = new incognito\Config\Configuration();
            $client = new incognito\PhpFirebaseCloudMessaging\FCMClient();
            $client->setApiKey($config->getApiKey());
            $client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

            $topic = 'notifications';

            $message = new incognito\PhpFirebaseCloudMessaging\Message();
            $message->setPriority('high');
            $message->addRecipient(new incognito\PhpFirebaseCloudMessaging\Recipient\Topic($topic));
            $message
                ->setNotification(new incognito\PhpFirebaseCloudMessaging\Notification('Obtained picture', $image_uploader->getTargetFile()))
                ->setData(['key' => 'value'])
            ;

            try {
                $response = $client->send($message);
                echo 'Notification is sent successfully to topic "'.$topic. '". '.$response->getBody()->getContents();
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