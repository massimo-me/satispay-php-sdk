<?php

namespace ChiarilloMassimo\Satispay\Handler;

use ChiarilloMassimo\Satispay\Utils\PropertyAccess;


/**
 * Class DailyClosureHandler
 * @package ChiarilloMassimo\Satispay\Handler
 */
class DailyClosureHandler extends AbstractHandler
{
    /**
     * https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#api-daily-closure
     *
     * @param \DateTime $dateTime
     *
     * @return mixed
     */
    public function getAmount(\DateTime $dateTime)
    {
        $response = $this->getClient()
            ->request(
                'GET',
                sprintf('/online/v1/daily_closure/%s', $dateTime->format('Ymd'))
            );

        $data = $response->getData();

        //@wip response is 403, need other token?
        return PropertyAccess::getValue($data, 'amount');
    }
}

