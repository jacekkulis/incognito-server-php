<?php
namespace incognito;
use \incognito\PhpFirebaseCloudMessaging\FCMClient;
use \GuzzleHttp\Client;
use \incognito\Config\Configuration;
use \incognito\PhpFirebaseCloudMessaging\Message;
use \incognito\PhpFirebaseCloudMessaging\Recipient\Topic;
use \incognito\PhpFirebaseCloudMessaging\Notification;

class NotificationSender
{
    private $config;
    private $client;

    public function __construct() {
        $this->config = new Configuration();
        $this->client = new FCMClient();
        $this->client->setApiKey($this->config->getApiKey());
        $this->client->injectGuzzleHttpClient(new Client());
    }

    public function sendNotification($title, $body){
        $message = new Message();
        $message->setPriority('high');
        $message->addRecipient(new Topic('notifications'));
        $message
            ->setNotification(new Notification($title, $body))
            ->setData(['key' => 'value'])
        ;

        return $this->client->send($message);
    }

}