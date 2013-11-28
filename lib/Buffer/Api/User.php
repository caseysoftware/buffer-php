<?php

namespace Buffer\Api;

use Buffer\HttpClient\HttpClient;

/**
 * Returns authenticated user api instance.
 *
 * @param $client HttpClient Instance
 */
class User
{

    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Returns information about the authenticated user.
     * '/user' GET
     *
     */
    public function show(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        return $this->client->get("/user", $body, $options);
    }

    /**
     * Returns an array of social media profiles connected to the authenticated users account.
     * '/profiles' GET
     *
     */
    public function profiles(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        return $this->client->get("/profiles", $body, $options);
    }

}
