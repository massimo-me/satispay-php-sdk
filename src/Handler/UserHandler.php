<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Http\Response;
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

        if (Response::HTTP_OK !== $response->getStatusCode()) {
            return false;
        }

        return (new User())
            ->setPhoneNumber($phoneNumber)
            ->setId($response->getProperty('id'));
    }
}

