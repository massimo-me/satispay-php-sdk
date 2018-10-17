<?php

namespace ChiarilloMassimo\Satispay;

use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Handler\AbstractHandler;
use ChiarilloMassimo\Satispay\Handler\AmountHandler;
use ChiarilloMassimo\Satispay\Handler\BearerHandler;
use ChiarilloMassimo\Satispay\Handler\ChargeHandler;
use ChiarilloMassimo\Satispay\Handler\DailyClosureHandler;
use ChiarilloMassimo\Satispay\Handler\RefundHandler;
use ChiarilloMassimo\Satispay\Handler\UserHandler;
use ChiarilloMassimo\Satispay\Http\Client;

/**
 * Class Satispay
 * @package ChiarilloMassimo\Satispay
 */
class Satispay
{
    /**
     * @var Bearer
     */
    protected $bearer;

    /**
     * @var string
     */
    protected $mode;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Satispay constructor.
     * @param Bearer $bearer
     * @param $mode
     */
    public function __construct(Bearer $bearer, $mode)
    {
        $this->bearer = $bearer;
        $this->mode = $mode;

        $this->client = (new Client($this->isLive()))
            ->setRequestOptions(
                [
                    'headers' => [
                        'Authorization' => sprintf('Bearer %s', $this->bearer->getToken()),
                        'Content-Type' => 'application/json'
                    ],
                    'verify' => $this->isLive()
                ]
            );
    }

    /**
     * @return bool
     */
    protected function isLive()
    {
        return ('live' === $this->mode);
    }

    /**
     * @param $class
     * @return mixed
     */
    protected function loadHandler($class)
    {
        $handler = new $class;

        if (! $handler instanceof AbstractHandler) {
            throw new \InvalidArgumentException(sprintf('Invalid handler: %s', $class));
        }

        $handler->setClient($this->client);

        return $handler;
    }

    /**
     * @return BearerHandler
     */
    public function getBearerHandler()
    {
        return $this->loadHandler(BearerHandler::class);
    }

    /**
     * @return UserHandler
     */
    public function getUserHandler()
    {
        return $this->loadHandler(UserHandler::class);
    }

    /**
     * @return ChargeHandler
     */
    public function getChargeHandler()
    {
        return $this->loadHandler(ChargeHandler::class);
    }

    /**
     * @return DailyClosureHandler
     */
    public function getDailyClosureHandler()
    {
        return $this->loadHandler(DailyClosureHandler::class);
    }

    /**
     * @return RefundHandler
     */
    public function getRefundHandler()
    {
        return $this->loadHandler(RefundHandler::class);
    }

    /**
     * @return AmountHandler
     */
    public function getAmountHandler()
    {
        return $this->loadHandler(AmountHandler::class);
    }
}
