<?php

namespace Buffer\Api;

use Buffer\HttpClient\HttpClient;

/**
 * Returns a social media profile api instance.
 *
 * @param $id Identifier of a social media profile
 */
class Profile
{

    private $id;
    private $client;

    public function __construct($id, HttpClient $client)
    {
        $this->id = $id;
        $this->client = $client;
    }

    /**
     * Returns details of the single specified social media profile.
     * '/profiles/:id' GET
     *
     */
    public function show(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/profiles/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Returns an array of updates that are currently in the buffer for an individual social media profile.
     * '/profiles/:id/updates/pending' GET
     *
     */
    public function pending(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/profiles/'.rawurlencode($this->id).'/updates/pending', $body, $options);

        return $response;
    }

    /**
     * Returns an array of updates that have been sent from the buffer for an individual social media profile.
     * '/profiles/:id/updates/sent' GET
     *
     */
    public function sent(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/profiles/'.rawurlencode($this->id).'/updates/sent', $body, $options);

        return $response;
    }

    /**
     * Edit the order at which statuses for the specified social media profile will be sent out of the buffer.
     * '/profiles/:id/updates/reorder' POST
     *
     * @param $order An ordered array of status update id's. This can be a partial array in combination with the offset parameter or a full array of every update in the profiles Buffer.
     */
    public function reorder($order, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['order'] = $order;

        $response = $this->client->post('/profiles/'.rawurlencode($this->id).'/updates/reorder', $body, $options);

        return $response;
    }

    /**
     * Randomize the order at which statuses for the specified social media profile will be sent out of the buffer.
     * '/profiles/:id/updates/shuffle' POST
     *
     */
    public function shuffle(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->post('/profiles/'.rawurlencode($this->id).'/updates/shuffle', $body, $options);

        return $response;
    }

}
