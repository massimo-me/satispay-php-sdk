<?php

namespace ChiarilloMassimo\Satispay\Http;

use ChiarilloMassimo\Satispay\Core\SatispayConstants;
use ChiarilloMassimo\Satispay\Exception\RequestException;
use ChiarilloMassimo\Satispay\Exception\SatispayException;
use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Client
 * @package ChiarilloMassimo\Satispay\Core
 */
class Client extends BaseClient
{
    /**
     * @var array
     */
    protected $requestOptions = [];

    /**
     * Client constructor.
     *
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
     * @return array
     */
    public function getRequestOptions()
    {
        return $this->requestOptions;
    }

    /**
     * @param array $requestOptions
     * @return $this
     */
    public function setRequestOptions($requestOptions)
    {
        $this->requestOptions = $requestOptions;

        return $this;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return Response|static
     * @throws SatispayException
     */
    public function request($method, $uri = '', array $options = [])
    {
        try {
            return Response::makeFromGuzzleResponse(
                parent::request(
                    $method,
                    $uri,
                    ($this->requestOptions) ? array_merge($this->requestOptions, $options) : $options
                )
            );
        } catch (ClientException $clientException) {
            $response = Response::makeFromGuzzleResponse(
                $clientException->getResponse()
            );

            throw new SatispayException(
                $response->getStatusCode(),
                $response->getProperty('message'),
                $response->getProperty('code')
            );
        }
    }

    /**
     * @param $name
     * @param $value
     * @return $this|void
     */
    public function addHeader($name, $value)
    {
        if (! array_key_exists('headers', $this->requestOptions)) {
            return;
        }

        $this->getRequestOptions()['headers'][$name] = $value;

        return $this;
    }
}
