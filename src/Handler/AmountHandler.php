<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Model\Amount;
use ChiarilloMassimo\Satispay\Utils\PropertyAccess;

class AmountHandler extends AbstractHandler
{
    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     *
     * @return Amount
     *
     * @throws \ChiarilloMassimo\Satispay\Exception\SatispayException
     */
    public function findBy(\DateTime $startDate, \DateTime $endDate)
    {
        $response = $this->getClient()
            ->request(
                'GET',
                '/online/v1/amounts',
                [
                    'query' => [
                        'starting_date' => $startDate->getTimestamp(),
                        'ending_date' => $endDate->getTimestamp(),
                    ]
                ]
            );

        $data = $response->getData();

        return new Amount(
            PropertyAccess::getValue($data, 'total_charge_amount_unit'),
            PropertyAccess::getValue($data, 'total_refund_amount_unit'),
            PropertyAccess::getValue($data, 'currency')
        );
    }
}
