<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Model\ArrayCollection;
use ChiarilloMassimo\Satispay\Model\Refund;

/**
 * Class RefundHandler
 * @package ChiarilloMassimo\Satispay\Handler
 */
class RefundHandler extends AbstractHandler
{
    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#get-a-refund
     *
     * @param $id
     *
     * @return Charge
     */
    public function findOneById($id)
    {
        return $this->loadEntityById(Refund::class, $id);
    }

    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#create-a-refund
     *
     * @param Refund $refund
     *
     * @return Refund
     */
    public function persist(Refund &$refund)
    {
        $response = $this->getClient()
            ->request(
                'POST',
                '/online/v1/refunds',
                [
                    'json' => $refund->toArray()
                ]
            );

        $refund = Refund::makeFromObject($response->getData());

        return $refund;
    }

    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#update-a-refund
     *
     * @param Refund $refund
     *
     * @return Refund
     */
    public function update(Refund &$refund)
    {
        $response = $this->getClient()
            ->request(
                'PUT',
                sprintf('/online/v1/refunds/%s', $refund->getId()),
                [
                    'json' => $refund->toArray()
                ]
            );

        return Refund::makeFromObject($response->getData());
    }

    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#get-a-refunds-list
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
            '/online/v1/refunds',
            $limit,
            $startingAfter,
            $endingBefore
        );

        return $this->createCollection(Refund::class, $response);
    }
}
