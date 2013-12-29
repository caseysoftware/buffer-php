<?php

namespace Buffer\Api;

use Buffer\HttpClient\HttpClient;

/**
 * Returns scheduling api instance for social media profile.
 *
 * @param $id Identifier of a social media profile
 */
class Schedule
{

    private $id;
    private $client;

    public function __construct($id, HttpClient $client)
    {
        $this->id = $id;
        $this->client = $client;
    }

    /**
     * Returns details of the posting schedules associated with a social media profile.
     * '/profiles/:id/schedules' GET
     *
     */
    public function list(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/profiles/'.rawurlencode($this->id).'/schedules', $body, $options);

        return $response;
    }

    /**
     * Set the posting schedules for the specified social media profile.
     * '/profiles/:id/schedules/update' POST
     *
     * @param $schedules Each item in the array is an individual posting schedule which consists of days and times to match the format return by the above method.
     */
    public function update($schedules, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['schedules'] = $schedules;

        $response = $this->client->post('/profiles/'.rawurlencode($this->id).'/schedules/update', $body, $options);

        return $response;
    }

}
