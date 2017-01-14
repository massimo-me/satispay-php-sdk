<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Model\ArrayCollection;
use ChiarilloMassimo\Satispay\Model\Charge;

/**
 * Class ChargeHandler
 * @package ChiarilloMassimo\Satispay\Handler
 */
class ChargeHandler extends AbstractHandler
{
    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#get-a-charge
     *
     * @param $id
     *
     * @return Charge
     */
    public function findOneById($id)
    {
        $response = $this->getClient()
            ->request(
                'GET',
                sprintf('/online/v1/charges/%s', $id)
            );

        return Charge::makeFromObject($response->getData());
    }

    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#create-a-charge
     *
     * @param Charge $charge
     * @param bool $pushNotification
     *
     * @return bool|Charge
     */
    public function persist(Charge &$charge, $pushNotification = false)
    {
        $response = $this->getClient()
            ->addHeader('x-satispay-skip-push', (bool) $pushNotification)
            ->request(
                'POST',
                '/online/v1/charges',
                [
                    'json' => $charge->toArray()
                ]
            );

        $charge = Charge::makeFromObject($response->getData());

        return $charge;
    }

    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#update-a-charge
     *
     * @param Charge $charge
     *
     * @return Charge;
     */
    public function update(Charge &$charge)
    {
        $response = $this->getClient()
            ->request(
                'PUT',
                sprintf('/online/v1/charges/%s', $charge->getId()),
                [
                    'json' => $charge->toArray()
                ]
            );

        return Charge::makeFromObject($response->getData());
    }

    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#get-a-charge-list
     *
     * @param int $limit
     * @param string $startingAfter
     * @param $endingBefore
     *
     * @return ArrayCollection
     */
    public function find($limit = 20, $startingAfter = '', $endingBefore = '')
    {
        $response = $this->findEntities(
            '/online/v1/charges',
            $limit,
            $startingAfter,
            $endingBefore
        );

        return $this->createCollection(Charge::class, $response);
    }
}

