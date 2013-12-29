<?php

namespace Buffer\Api;

use Buffer\HttpClient\HttpClient;

/**
 * Returns api instance to get information about links shared through Buffer.
 *
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
        $body = (isset($options['query']) ? $options['query'] : array());
        $body['url'] = $url;

        $response = $this->client->get('/link/shares', $body, $options);

        return $response;
    }

}
