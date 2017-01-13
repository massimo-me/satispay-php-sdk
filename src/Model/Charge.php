<?php

namespace ChiarilloMassimo\Satispay\Model;

use ChiarilloMassimo\Satispay\Http\Response;

/**
 * Class Charge
 * @package ChiarilloMassimo\Satispay\Model
 */
class Charge
{
    //Charge sent to a user waitng for acceptance
    const STATUS_REQUIRED = 'REQUIRED';

    //Charge accepted by the user
    const STATUS_SUCCESS = 'SUCCESS';

    //Charge failed, more details can be found on STATUS_DETAIL
    const STATUS_FAILURE = 'FAILURE';

    //User declined the Charge
    const DECLINED_BY_PAYER = 'DECLINED_BY_PAYER';

    //User declined the Charge because he did not request it
    const DECLINED_BY_PAYER_NOT_REQUIRED = 'DECLINED_BY_PAYER_NOT_REQUIRED';

    //Same Charge sent to the same user, the second will override the first
    const CANCEL_BY_NEW_CHARGE = 'CANCEL_BY_NEW_CHARGE';

    //Generic error
    const INTERNAL_FAILURE = 'INTERNAL_FAILURE';

    //The Charge has expired
    const EXPIRED = 'EXPIRED';

    /**
     * @var string
     */
    protected $id;

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
    protected $extraFields = [];

    /**
     * @var bool
     */
    protected $sendMail;

    /**
     * @var int
     */
    protected $expireMinutes = 15;

    /**
     * @var \DateTime
     */
    protected $expireDate;

    /**
     * @var string
     */
    protected $callbackUrl;

    /**
     * @var bool
     */
    protected $paid;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $details;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * @return \DateTime
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * @param \DateTime $expireDate
     * @return $this
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;

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
     * @return boolean
     */
    public function isPaid()
    {
        return $this->paid;
    }

    /**
     * @param boolean $paid
     * @return $this
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param string $details
     * @return $this
     */
    public function setDetails($details)
    {
        $this->details = $details;

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
            'metadata' => $this->getExtraFields(),
            'required_success_email' => $this->getSendMail(),
            'expire_in' => $this->getExpireMinutes(),
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

    /**
     * @param Response $response
     * @return static
     */
    public static function makeFromResponse(Response $response)
    {
        $charge = new static();

        $user = new User($response->getProperty('user_id'));

        $charge
            ->setId($response->getProperty('id'))
            ->setDescription($response->getProperty('description'))
            ->setCurrency($response->getProperty('currency'))
            ->setAmount($response->getProperty('amount'))
            ->setStatus($response->getProperty('status'))
            ->setUser($user->setShortName($response->getProperty('user_short_name')))
            ->setExtraFields(get_object_vars($response->getProperty('metadata')))
            ->setPaid($response->getProperty('paid'))
            ->setSendMail($response->getProperty('required_success_mail'))
            ->setExpireDate(new \DateTime($response->getProperty('expire_date')))
            ->setCallbackUrl($response->getProperty('callback_url'))
            ->setDetails($response->getProperty('status_details'))
        ;

        return $charge;
    }
}
