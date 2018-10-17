<?php

namespace ChiarilloMassimo\Satispay\Model;

use ChiarilloMassimo\Satispay\Utils\PropertyAccess;

/**
 * Class Charge.
 */
class Charge extends AbstractEntity
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
    protected $currency = 'EUR';

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var null|array
     */
    protected $extraFields = null;

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
    protected $detail;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
     * @return $this
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPaid()
    {
        return $this->paid;
    }

    /**
     * @param bool $paid
     *
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
     *
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
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     *
     * @return $this
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

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
            'callback_url' => $this->getCallbackUrl(),
        ];
    }

    /**
     * @param object $object
     *
     * @return static
     */
    public static function makeFromObject($object)
    {
        $charge = new static();

        $user = (new User(PropertyAccess::getValue($object, 'user_id')))
            ->setShortName(PropertyAccess::getValue($object, 'user_short_name'));

        $extraFields = PropertyAccess::getValue($object, 'metadata');

        if (is_array($extraFields)) {
            $extraFields = get_object_vars($extraFields);
        }

        $expireDate = new \DateTime(PropertyAccess::getValue($object, 'expire_date'));

        $charge
            ->setId(PropertyAccess::getValue($object, 'id'))
            ->setUser($user)
            ->setExtraFields($extraFields)
            ->setExpireDate($expireDate)
            ->setDescription(PropertyAccess::getValue($object, 'description'))
            ->setCurrency(PropertyAccess::getValue($object, 'currency'))
            ->setAmount(PropertyAccess::getValue($object, 'amount'))
            ->setStatus(PropertyAccess::getValue($object, 'status'))
            ->setPaid(PropertyAccess::getValue($object, 'paid'))
            ->setSendMail(PropertyAccess::getValue($object, 'required_success_mail'))
            ->setCallbackUrl(PropertyAccess::getValue($object, 'callback_url'))
            ->setDetail(PropertyAccess::getValue($object, 'status_detail'))
        ;

        return $charge;
    }
}
