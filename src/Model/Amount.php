<?php

namespace ChiarilloMassimo\Satispay\Model;

class Amount
{
    /**
     * @var int
     */
    protected $totalCharge;

    /**
     * @var int
     */
    protected $totalRefund;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @param $totalCharge
     * @param $totalRefund
     * @param $currency
     */
    public function __construct(
        $totalCharge,
        $totalRefund,
        $currency
    )
    {
        $this->totalCharge = $totalCharge;
        $this->totalRefund = $totalRefund;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getTotalCharge()
    {
        return $this->totalCharge;
    }

    /**
     * @return int
     */
    public function getTotalRefund()
    {
        return $this->totalRefund;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
