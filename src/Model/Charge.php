<?php

namespace ChiarilloMassimo\Satispay\Model;

/**
 * Class Charge
 * @package ChiarilloMassimo\Satispay\Model
 */
class Charge
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var array
     */
    protected $metadata = [];

    /**
     * @var bool
     */
    protected $sendMail;

    /**
     * @var int
     */
    protected $expireMinutes = 15;

    /**
     * @var string
     */
    protected $callbackUrl;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param mixed $metadata
     * @return $this
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSendMail()
    {
        return $this->sendMail;
    }

    /**
     * @param mixed $sendMail
     * @return $this
     */
    public function setSendMail($sendMail)
    {
        $this->sendMail = $sendMail;

        return $this;
    }

    /**
     * @return int
     */
    public function getExpireMinutes()
    {
        return $this->expireMinutes;
    }

    /**
     * @param int $expireMinutes
     * @return $this
     */
    public function setExpireMinutes($expireMinutes)
    {
        $this->expireMinutes = $expireMinutes;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * @param mixed $callbackUrl
     * @return $this
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'user_id' => $this->getUser()->getId(),
            'description' => $this->getDescription(),
            'currency' => $this->getCurrency(),
            'amount' => $this->getAmount(),
            'metadata' => $this->getMetadata(),
            'required_success_email' => $this->getSendMail(),
            'expire_in' => $this->getExpire(),
            'callback_url' => $this->getCallbackUrl()
        ];
    }

    /**
     * @return string
     */
    public function toJSON()
    {
        return json_encode($this->toArray());
    }
}
