<?php
namespace incognito\PhpFirebaseCloudMessaging;

use GuzzleHttp;

/**
 *
 * @author Jacek
 *
 */
interface FCMClientInterface
{

    /**
     * add your server api key here
     * read how to obtain an api key here: https://firebase.google.com/docs/server/setup#prerequisites
     *
     * @param string $apiKey
     *
     * @return \incognito\PhpFirebaseCloudMessaging\Client
     */
    function setApiKey($apiKey);

    /**
     * sends your notification to the google servers and returns a guzzle repsonse object
     * containing their answer.
     *
     * @param Message $message
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\RequestException
     */
    function send(Message $message);
    
}
   