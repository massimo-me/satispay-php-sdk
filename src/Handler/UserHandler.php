<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Model\User;

/**
 * Class UserHandler
 * @package ChiarilloMassimo\Satispay\Handler
 */
class UserHandler extends AbstractHandler
{
    /**
     * @param $phoneNumber
     * @return bool
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

        return (new User())
            ->setPhoneNumber($phoneNumber)
            ->setId($response->getProperty('id'));
    }

    /**
     * @param $id
     * @return bool|User
     */
    public function get($id)
    {
        $response = $this->getClient()->request(
            'GET',
            sprintf('/online/v1/users/%s', $id)
        );

        if (! $this->isResponseOk($response)) {
            return false;
        }

        return (new User())
            ->setId($response->getProperty('id'))
            ->setPhoneNumber($response->getProperty('phone_number'));
    }
}

