<?php

include 'config.php';

use ChiarilloMassimo\Satispay\Model\Charge;

$charge = new Charge();
$charge
    ->setUser($satispay->getUserHandler()->createByPhoneNumber('+39 phone'))
    ->setAmount(15) // 0.15 €
    ->setCallbackUrl('http://fakeurl.com/satispay-callback')
    ->setCurrency('EUR')
    ->setDescription('Test description')
    ->setExpireMinutes(20)
    ->setExtraFields([
        'orderId' => 'id',
        'extra' => 'extra'
    ])
    ->setSendMail(false);


$satispay->getChargeHandler()->persist($charge, true);

$charge->getId();
$charge->isPaid();
$charge->getStatus();
