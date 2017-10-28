<?php
/**
 This is waiter script for Raspberry Pi. This script waits for POST informaton from Raspberry that want do something - send image, send information etc.
 */

$status = 0;
$client = "";
$request = "";

// check if Android or Raspberry want something
if (isset($_POST['client'])){
    $client = $_POST['client'];
}
else {
    $status = 0;
    echo 'Client is not set.';
}

if (isset($_POST['request'])){
    $request = $_POST['request'];
}
else {
    $status = 0;
    echo 'Request is not set.';
}


//


?>