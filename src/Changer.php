
<!DOCTYPE html>
<html>
<body>

<form method="post">
   CHANGE TO TRUE </br>
    <input type="submit" value="TRUE" name="true"></br></br></br>
</form>

<form method="post">
    CHANGE TO FALSE </br>
    <input type="submit" value="FALSE" name="false">
</form>

</body>
</html>

<?php
/**
This is waiter script for Raspberry Pi. This script waits for POST informaton from Raspberry that want do something - send image, send information etc.
 */

require "/storage/ssd5/051/3004051/public_html/IncognitoServer/vendor/autoload.php";
//require "../vendor/autoload.php";

if (isset($_POST['false'])){
    // image get - change true to false
    $raspFile = fopen("request.txt", "wb");
    fwrite($raspFile, json_encode("false"));
    fclose($raspFile);
}

if (isset($_POST['true'])){
    // image get - change true to false
    $raspFile = fopen("request.txt", "wb");
    fwrite($raspFile, json_encode("true"));
    fclose($raspFile);
}

?>