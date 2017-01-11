<?php

namespace ChiarilloMassimo\Satispay;

use ChiarilloMassimo\Satispay\Core\SatispayConstants;
use ChiarilloMassimo\Satispay\Exception\RequestException;
use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Client
 * @package ChiarilloMassimo\Satispay\Core
 */
class Client extends BaseClient
{
    /**
     * Client constructor.
     * @param array $isLive
     * @param array $config
     */
    public function __construct($isLive, array $config = [])
    {
        parent::__construct(
            $config + [
                'base_uri' => ($isLive) ? SatispayConstants::LIVE_ENDPOINT : SatispayConstants::SANDBOX_ENDPOINT
            ]
        );
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws RequestException
     */
    public function request($method, $uri = '', array $options = [])
    {
        try {
            return parent::request($method, $uri, $options);
        } catch (ClientException $clientException) {
            $response = json_decode(
                $clientException->getResponse()->getBody()->getContents()
            );

            throw new RequestException(
                $clientException->getCode(),
                $response->message,
                $response->code
            );
        }
    }
}
