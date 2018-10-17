<?php

include 'config.php';

//Return ChiarilloMassimo\Satispay\Model\Amount
$amount = $satispay->getAmountHandler()->findBy(
    new DateTime('2018-01-01'),
    new DateTime('now')
);
