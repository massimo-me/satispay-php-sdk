<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Http\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BearerHandler
 * @package ChiarilloMassimo\Satispay\Handler
 */
class BearerHandler extends AbstractHandler
{
    /**
     * @return bool
     */
    public function isAuthorized()
    {
        $response = $this->getClient()->request(
            'GET',
            '/wally-services/protocol/authenticated'
        );


        if (! $response instanceof Response) {
            return false;
        }

        return (Response::HTTP_NO_CONTENT === $response->getStatusCode());
    }
}

