<?php
namespace incognito\Config;


class Configuration implements \JsonSerializable
{
    /**
     * Api key alue set manually.
     */
    private $apiKey = 'AAAAC31dYQA:APA91bF_Qg4PpWfUYVSgu6sKMYhX7zKgCCVgKSbq-qf7hRy3Y4-b8TssEAc2zveYNyyuClQIOTb9aMYx6u9muDl7j63EswMEu2JsWQplV4HQooMQljs9esKMsNOaY1RMi_dBXy1WjI15';
    private $otherData;

    private $jsonData;


    public function __construct() {
        $this->jsonData = [];
    }

    /**
     * Set root message data via key
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setJsonKey($key, $value) {
        $this->jsonData[$key] = $value;
        return $this;
    }

    /**
     * Unset root message data via key
     *
     * @param string $key
     * @return $this
     */
    public function unsetJsonKey($key) {
        unset($this->jsonData[$key]);
        return $this;
    }

    /**
     * Get root message data via key
     *
     * @param string $key
     * @return mixed
     */
    public function getJsonKey($key) {
        return $this->jsonData[$key];
    }

    /**
     * Get root message data
     *
     * @return array
     */
    public function getJsonData() {
        return $this->jsonData;
    }

    /**
     * Set root message data
     *
     * @param array $array
     * @return $this
     */
    public function setJsonData($array) {
        $this->jsonData = $array;
        return $this;
    }

    public function jsonSerialize()
    {
        $jsonData = $this->jsonData;

        // some validation
        if (empty($this->apiKey)) {
            throw new \UnexpectedValueException('Api key must be set!');
        }

        if ($this->apiKey) {
            $jsonData['apiKey'] = $this->apiKey;
        }

        return $jsonData;
    }


}