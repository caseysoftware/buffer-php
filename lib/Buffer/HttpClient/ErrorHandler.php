<?php

namespace Buffer\HttpClient;

use Guzzle\Common\Event;
use Guzzle\Http\Message\Response;

use Buffer\HttpClient\ResponseHandler;
use Buffer\Exception\ClientException;

/**
 * ErrorHanlder takes care of selecting the error message from response body
 */
class ErrorHandler
{
    public function onRequestError(Event $event)
    {
        $request = $event['request'];
        $response = $request->getResponse();

        $content = ResponseHandler::getBody($response);

        if ($response->isClientError() || $response->isServerError()) {
            $error = null;

            // If HTML, whole body is taken
            if (gettype($content) == "string") {
                $error = new ClientException($content, $response->getStatusCode());
            }

            // If JSON, a particular field is taken and used
            if ($response->isContentType('json') && is_array($content) && isset($content['error'])) {
                $error = new ClientException($content['error'], $response->getStatusCode());
            } else {
                $error = new ClientException("Unable to select error message from json returned by request responsible for error", $response->getStatusCode());
            }

            if (empty($error)) {
                $error = new \RuntimeException("Unable to understand the content type of response returned by request responsible for error", $response->getStatusCode());
            }
        }
    }
}
