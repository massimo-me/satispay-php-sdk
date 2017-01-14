<?php

namespace ChiarilloMassimo\Satispay\Model;

use ChiarilloMassimo\Satispay\Utils\PropertyAccess;

/**
 * Class Refund
 * @package ChiarilloMassimo\Satispay\Model
 */
class Refund extends AbstractEntity
{
    //Duplicate charge
    const DUPLICATE = 'DUPLICATE';

    //Fraudolent charge
    const FRAUDULENT = 'FRAUDULENT';

    //Request by customer
    const REQUESTED_BY_CUSTOMER = 'REQUESTED_BY_CUSTOMER';

    /**
     * @var Charge
     */
    protected $charge;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency = 'EUR';

    /**
     * @var string
     */
    protected $reason;

    /**
     * @var null|array
     */
    protected $extraFields = null;

    /**
     * @var null|\DateTime
     */
    protected $created;

    /**
     * @return Charge
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @param Charge $charge
     * @return $this
     */
    public function setCharge($charge)
    {
        $this->charge = $charge;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param string $reason
     * @return $this
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * @return array
     */
    public function getExtraFields()
    {
        return $this->extraFields;
    }

    /**
     * @param array $extraFields
     * @return $this
     */
    public function setExtraFields($extraFields)
    {
        $this->extraFields = $extraFields;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime|null $created
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'charge_id' => $this->getCharge()->getId(),
            'description' => $this->getDescription(),
            'currency' => $this->getCurrency(),
            'amount' => $this->getAmount(),
            'reason' => $this->getReason(),
            'metadata' => $this->getExtraFields()
        ];
    }

    /**
     * @param $object
     * @return static
     */
    public static function makeFromObject($object)
    {
        $refund = new static();

        $created = new \DateTime(PropertyAccess::getValue($object, 'created'));
        $extraFields = PropertyAccess::getValue($object, 'metadata');

        if (is_array($extraFields)) {
            $extraFields = get_object_vars($extraFields);
        }

        $charge = (new Charge())->setId(PropertyAccess::getValue($object, 'charge_id'));

        $refund
            ->setId(PropertyAccess::getValue($object, 'id'))
            ->setCharge($charge)
            ->setDescription(PropertyAccess::getValue($object, 'description'))
            ->setAmount(PropertyAccess::getValue($object, 'amount'))
            ->setCurrency(PropertyAccess::getValue($object, 'currency'))
            ->setCreated($created)
            ->setReason(PropertyAccess::getValue($object, 'reason'))
            ->setExtraFields($extraFields);

        return $refund;
    }
}
