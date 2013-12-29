<?php

namespace Buffer\Api;

use Buffer\HttpClient\HttpClient;

/**
 * Returns authenticated user api instance.
 *
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
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/user', $body, $options);

        return $response;
    }

    /**
     * Returns an array of social media profiles connected to the authenticated users account.
     * '/profiles' GET
     *
     */
    public function profiles(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/profiles', $body, $options);

        return $response;
    }

    /**
     * Create one or more new status updates.
     * '/updates/create' POST
     *
     * @param $text The status update text.
     * @param $profile_ids An array of profile id's that the status update should be sent to. Invalid profile_id's will be silently ignored.
     */
    public function createUpdate($text, $profile_ids, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['text'] = $text;
        $body['profile_ids'] = $profile_ids;

        $response = $this->client->post('/updates/create', $body, $options);

        return $response;
    }

}
