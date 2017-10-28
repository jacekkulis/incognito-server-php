<?php
require "vendor/autoload.php";

$config = new incognito\Config\Configuration();
$client = new incognito\PhpFirebaseCloudMessaging\FCMClient();
$client->setApiKey($config->getApiKey());
$client->injectGuzzleHttpClient(new \GuzzleHttp\Client());

$topic = 'notifications';

$message = new incognito\PhpFirebaseCloudMessaging\Message();
$message->setPriority('high');
$message->addRecipient(new incognito\PhpFirebaseCloudMessaging\Recipient\Topic($topic));
$message
    ->setNotification(new incognito\PhpFirebaseCloudMessaging\Notification('Default title', 'Default Body Text'))
    ->setData(['key' => 'value'])
;

try {
    $response = $client->send($message);
    return 'Notification is sent successfully to topic "'.$topic. '". '.$response->getBody()->getContents();
} catch (Exception $ex) {
    return 'Error: ' .$ex->getMessage();
}

?>