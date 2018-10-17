<?php

namespace ChiarilloMassimo\Satispay\Http;

use ChiarilloMassimo\Satispay\Core\SatispayConstants;
use ChiarilloMassimo\Satispay\Exception\SatispayException;
use ChiarilloMassimo\Satispay\Utils\PropertyAccess;
use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Client.
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
                'base_uri' => ($isLive) ? SatispayConstants::LIVE_ENDPOINT : SatispayConstants::SANDBOX_ENDPOINT,
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
     *
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
     * @param array  $options
     *
     * @throws SatispayException
     *
     * @return Response|static
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

            $data = $response->getData();

            throw new SatispayException(
                $response->getStatusCode(),
                PropertyAccess::getValue($data, 'message'),
                PropertyAccess::getValue($data, 'code')
            );
        }
    }

    /**
     * @param $name
     * @param $value
     *
     * @return $this|void
     */
    public function addHeader($name, $value)
    {
        if (!array_key_exists('headers', $this->requestOptions)) {
            return;
        }

        $this->getRequestOptions()['headers'][$name] = $value;

        return $this;
    }

    /**
     * @param array $headers
     *
     * @return $this
     */
    public function addHeaders(array $headers = [])
    {
        foreach ($headers as $name => $value) {
            $this->addHeader($name, $value);
        }

        return $this;
    }
}
