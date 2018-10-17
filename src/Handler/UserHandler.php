<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Model\ArrayCollection;
use ChiarilloMassimo\Satispay\Model\User;
use ChiarilloMassimo\Satispay\Utils\PropertyAccess;

/**
 * Class UserHandler.
 */
class UserHandler extends AbstractHandler
{
    /**
     * @see https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#create-a-user
     *
     * @param User $user
     *
     * @return User
     */
    public function persist(User &$user)
    {
        $response = $this->getClient()->request(
            'POST',
            '/online/v1/users',
            [
                'json' => $user->toArray(),
            ]
        );

        $data = $response->getData();

        $user->setId(PropertyAccess::getValue($data, 'id'));

        return $user;
    }

    /**
     * @param $phoneNumber
     *
     * @return User
     */
    public function createByPhoneNumber($phoneNumber)
    {
        $user = new User(null, $phoneNumber);

        return $this->persist($user);
    }

    /**
     * @see https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#get-a-user
     *
     * @param $id
     *
     * @return User
     */
    public function findOneById($id)
    {
        $response = $this->getClient()
            ->request(
                'GET',
                sprintf('/online/v1/users/%s', $id)
            );

        return User::makeFromObject($response->getData());
    }

    /**
     * @see https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#get-a-user-list
     *
     * @param int    $limit
     * @param string $startingAfter
     * @param $endingBefore
     *
     * @return ArrayCollection
     */
    public function find($limit = 20, $startingAfter = '', $endingBefore = '')
    {
        $response = $this->findEntities(
            '/online/v1/users',
            $limit,
            $startingAfter,
            $endingBefore
        );

        return $this->createCollection(User::class, $response);
    }
}
