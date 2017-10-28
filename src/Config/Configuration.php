<?php
namespace incognito\Config;


class Configuration
{
    const DEFAULT_API_KEY = 'AAAAC31dYQA:APA91bF_Qg4PpWfUYVSgu6sKMYhX7zKgCCVgKSbq-qf7hRy3Y4-b8TssEAc2zveYNyyuClQIOTb9aMYx6u9muDl7j63EswMEu2JsWQplV4HQooMQljs9esKMsNOaY1RMi_dBXy1WjI15';

    private $apiKey;

    /**
     * Initializes configuration with manually set api key.
     */
    public function __construct()
    {
        $this->apiKey = self::DEFAULT_API_KEY;
        return $this;
    }

    /**
     * add your server api key here
     * read how to obtain an api key here: https://firebase.google.com/docs/server/setup#prerequisites
     *
     * @param string $apiKey
     *
     * @return \incognito\Config\Configuration
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function setDefaultApiKey(){
        $this->apiKey = self::DEFAULT_API_KEY;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }
}