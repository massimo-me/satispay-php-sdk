<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Http\Client;
use ChiarilloMassimo\Satispay\Http\Response;
use ChiarilloMassimo\Satispay\Model\ArrayCollection;
use ChiarilloMassimo\Satispay\Utils\PropertyAccess;

/**
 * Class AbstractHandler
 * @package ChiarilloMassimo\Satispay\Handler
 */
abstract class AbstractHandler
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param Response $response
     * @return bool
     */
    public function isResponseOk(Response $response)
    {
        return (Response::HTTP_OK === $response->getStatusCode());
    }

    /**
     * @param $path
     * @param int $limit
     * @param string $startingAfter
     * @param string $endingBefore
     *
     * @return Response
     */
    public function findEntities($path, $limit = 20, $startingAfter = '', $endingBefore = '')
    {
        $response = $this->getClient()
            ->request(
                'GET',
                $path,
                [
                    'query' =>
                        [
                            'limit' => $limit,
                            'starting_after' => ($startingAfter) ? $startingAfter : null,
                            'ending_before' => ($endingBefore) ? $endingBefore : null
                        ]
                ]
            );

        return $response;
    }

    /**
     * @param $class
     * @param Response $response
     *
     * @return ArrayCollection
     */
    public function createCollection($class, Response $response)
    {
        $data = $response->getData();

        return new ArrayCollection(
            array_map(
                function($object) use ($class) {
                    return call_user_func_array(
                        [
                            $class,
                            'makeFromObject'
                        ],
                        [
                            $object
                        ]
                    );
                },
                PropertyAccess::getValue($data, 'list')
            ),
            PropertyAccess::getValue($data, 'has_more')
        );
    }
}
