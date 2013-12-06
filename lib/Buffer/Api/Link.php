<?php

namespace Buffer\Api;

use Buffer\HttpClient\HttpClient;

/**
 * Returns api instance to get information about links shared through Buffer.
 *
 * @param $client HttpClient Instance
 */
class Link
{

    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Returns an object with a the numbers of shares a link has had using Buffer.
     * '/link/shares' GET
     *
     * @param $url URL of the page for which the number of shares is requested.
     */
    public function shares($url, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['url'] = $url;

        return $this->client->get("/link/shares", $body, $options);
    }

}