<?php
require "vendor/autoload.php"; 

use incognito\PhpFirebaseCloudMessaging\FCMClient;
use incognito\PhpFirebaseCloudMessaging\Message;
use incognito\PhpFirebaseCloudMessaging\Recipient\Device;
use incognito\PhpFirebaseCloudMessaging\Notification;

$config = include('Config/config.php');
$client = new incognito\PhpFirebaseCloudMessaging\FCMClient();
$client->setApiKey($config['apiKey']);
$client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

$message = new Message();
$message->setPriority('high');
$message->addRecipient(new Device($config['androidDeviceToken']));
$message->setNotification(new Notification('some title', 'hello'))->setData(['key' => 'value']);

try {
    $response = $client->send($message);
    var_dump($response->getStatusCode());
    var_dump($response->getBody()->getContents());
} catch (Exception $ex) {
    echo 'Message: ' .$ex->getMessage();
}

?>