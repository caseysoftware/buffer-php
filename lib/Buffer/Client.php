<?php

namespace Buffer;

use Buffer\HttpClient\HttpClient;

class Client
{
    private $httpClient;

    public function __construct($auth = array(), array $options = array())
    {
        $this->httpClient = new HttpClient($auth, $options);
    }

    /**
     * Returns api instance to get auxilary information about Buffer useful when creating your app.
     *
     */
    public function info()
    {
        return new Api\Info($this->httpClient);
    }

    /**
     * Returns authenticated user api instance.
     *
     */
    public function user()
    {
        return new Api\User($this->httpClient);
    }

    /**
     * Returns api instance to get information about links shared through Buffer.
     *
     */
    public function link()
    {
        return new Api\Link($this->httpClient);
    }

    /**
     * Returns a social media profile api instance.
     *
     * @param $id Identifier of a social media profile
     */
    public function profile($id)
    {
        return new Api\Profile($id, $this->httpClient);
    }

    /**
     * Returns scheduling api instance for social media profile.
     *
     * @param $id Identifier of a social media profile
     */
    public function schedule($id)
    {
        return new Api\Schedule($id, $this->httpClient);
    }

    /**
     * Returns a social media update api instance.
     *
     * @param $id Identifier of a social media update
     */
    public function update($id)
    {
        return new Api\Update($id, $this->httpClient);
    }

}
