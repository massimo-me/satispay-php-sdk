<?php

include 'config.php';

use \ChiarilloMassimo\Satispay\Model\Refund;

$charge = $satispay->getChargeHandler()->findOneById('id');

$refund = new Refund();
$refund
    ->setCharge($charge)
    ->setDescription('Test')
    ->setAmount(15)
    ->setReason(Refund::DUPLICATE);

$satispay->getRefundHandler()->persist($refund);
