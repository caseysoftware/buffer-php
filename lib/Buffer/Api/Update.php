<?php

namespace Buffer\Api;

use Buffer\HttpClient\HttpClient;

/**
 * Returns a social media update api instance.
 *
 * @param $id Identifier of a social media update
 */
class Update
{

    private $id;
    private $client;

    public function __construct($id, HttpClient $client)
    {
        $this->id = $id;
        $this->client = $client;
    }

    /**
     * Returns a single social media update.
     * '/updates/:id' GET
     *
     */
    public function show(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/updates/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Returns the detailed information on individual interactions with the social media update such as favorites, retweets and likes.
     * '/updates/:id/interactions' GET
     *
     */
    public function interactions(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/updates/'.rawurlencode($this->id).'/interactions', $body, $options);

        return $response;
    }

    /**
     * Edit an existing, individual status update.
     * '/updates/:id/update' POST
     *
     * @param $text The status update text.
     */
    public function update($text, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['text'] = $text;

        $response = $this->client->post('/updates/'.rawurlencode($this->id).'/update', $body, $options);

        return $response;
    }

    /**
     * Immediately shares a single pending update and recalculates times for updates remaining in the queue.
     * '/updates/:id/share' POST
     *
     */
    public function share(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->post('/updates/'.rawurlencode($this->id).'/share', $body, $options);

        return $response;
    }

    /**
     * Permanently delete an existing status update.
     * '/updates/:id/destroy' POST
     *
     */
    public function destroy(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->post('/updates/'.rawurlencode($this->id).'/destroy', $body, $options);

        return $response;
    }

    /**
     * Move an existing status update to the top of the queue and recalculate times for all updates in the queue. Returns the update with its new posting time.
     * '/updates/:id/move_to_top' POST
     *
     */
    public function top(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->post('/updates/'.rawurlencode($this->id).'/move_to_top', $body, $options);

        return $response;
    }

}
