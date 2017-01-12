<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Model\User;
use ChiarilloMassimo\Satispay\Model\UserCollection;

/**
 * Class UserHandler
 * @package ChiarilloMassimo\Satispay\Handler
 */
class UserHandler extends AbstractHandler
{
    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#create-a-user
     *
     * @param $phoneNumber
     *
     * @return bool|User
     */
    public function create($phoneNumber)
    {
        $response = $this->getClient()->request(
            'POST',
            '/online/v1/users',
            [
                'json' => [
                    'phone_number' => $phoneNumber
                ]
            ]
        );

        if (! $this->isResponseOk($response)) {
            return false;
        }

        return new User(
            $response->getProperty('id'),
            $phoneNumber
        );
    }

    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#get-a-user
     *
     * @param $id
     *
     * @return null|User
     */
    public function findOneById($id)
    {
        $response = $this->getClient()->request(
            'GET',
            sprintf('/online/v1/users/%s', $id)
        );

        if (! $this->isResponseOk($response)) {
            return null;
        }

        return new User(
            $response->getProperty('id'),
            $response->getProperty('phone_number')
        );
    }

    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#get-a-user-list
     *
     * @param int $limit
     * @param string $startingAfter
     * @param $endingBefore
     *
     * @return null|UserCollection
     */
    public function find($limit = 20, $startingAfter = '', $endingBefore = '')
    {
        $response = $this->getClient()->request(
            'GET',
            '/online/v1/users', [
                'query' =>
                    [
                        'limit' => $limit,
                        'starting_after' => ($startingAfter) ? $startingAfter : null,
                        'ending_before' => ($endingBefore) ? $endingBefore : null
                    ]
            ]
        );

        if (! $this->isResponseOk($response)) {
            return null;
        }

        return new UserCollection(
            array_map(
                function($object) {
                    return new User(
                        $object->id,
                        $object->phone_number
                    );
                },
                $response->getProperty('list')
            ),
            $response->getProperty('has_more')
        );
    }
}

