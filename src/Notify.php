<?php
require "vendor/autoload.php"; 

use incognito\PhpFirebaseCloudMessaging\Message;
use incognito\PhpFirebaseCloudMessaging\Notification;

$config = include('Config/config.php');
$client = new incognito\PhpFirebaseCloudMessaging\FCMClient();
$client->setApiKey($config['apiKey']);
$client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

$topic = 'notifications';

$message = new Message();
$message->setPriority('high');
$message->addRecipient(new incognito\PhpFirebaseCloudMessaging\Recipient\Topic($topic));
$message
    ->setNotification(new Notification('Tutaj mamy tytul', 'heheheheheszky'))
    ->setData(['key' => 'value'])
;

try {
    $response = $client->send($message);
    return 'Notification is sent successfully to topic "'.$topic. '". '.$response->getBody()->getContents();
} catch (Exception $ex) {
    return 'Error: ' .$ex->getMessage();
}

?>