
<?php
/**
This is waiter script for Raspberry Pi. This script waits for POST informaton from Raspberry that want do something - send image, send information etc.
 */

require "/storage/ssd5/051/3004051/public_html/IncognitoServer/vendor/autoload.php";
//require "../vendor/autoload.php";

$fp = fopen("myPost1.txt", "wb", FILE_APPEND);

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

if (isset($_POST['client']) && isset($_POST['request'])){
    $client = $_POST['client'];
    $request = $_POST['request'];

    if (strcmp($client, "android") == 0) {
        fwrite($fp, json_encode("android"));
        if (strcmp($request, "camera") == 0) {
            fwrite($fp, json_encode("REQUEST: camera"));
            $response['message'] = "Android requested camera.";
            //send request to raspberry
            // File that contains info if raspberry wants image or not.
            $raspFile = fopen("request.txt", "wb");
            fwrite($raspFile, json_encode("true"));
            fclose($raspFile);
            fwrite($fp, json_encode("camera"));
        }
    }

    sleep(10);
}

$url = file_get_contents("android.txt");

if (isset($url)){
    fwrite($fp, json_encode("url is defined: " . $url));
    $response['error'] = false;
    $response['message'] = "File is uploaded and url is sent to android.";
    $response['pictureUrl'] = $url;
    echo json_encode($response );
}
else {
    fwrite($fp, json_encode("url is not set"));
    echo json_encode($response, JSON_UNESCAPED_SLASHES );
}

fclose($fp);
?>