<?php

namespace ChiarilloMassimo\Satispay\Handler;

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
     * @return null|Charge
     */
    public function findOneById($id)
    {
        $response = $this->getClient()
            ->request(
                'GET',
                sprintf('/online/v1/charges/%s', $id)
            );

        if (! $this->isResponseOk($response)) {
            return null;
        }

        return Charge::makeFromResponse($response);
    }

    /**
     * @link https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#create-a-charge
     *
     * @param Charge $charge
     * @param bool $skipPushNotification
     *
     * @return bool|Charge
     */
    public function persist(Charge &$charge, $skipPushNotification = false)
    {
        $response = $this->getClient()
            ->addHeader('x-satispay-skip-push', (bool) $skipPushNotification)
            ->request(
                'POST',
                '/online/v1/charges',
                [
                    'json' => $charge->toArray()
                ]
            );

        if (! $this->isResponseOk($response)) {
            return false;
        }

        $charge = Charge::makeFromResponse($response);

        return $charge;
    }
}

