<?php

include __DIR__ . '/../vendor/autoload.php';

use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_...'),
    'sandbox'
);

use ChiarilloMassimo\Satispay\Model\User;

//Return ChiarilloMassimo\Satispay\Model\User
var_dump($satispay->getUserHandler()->createByPhoneNumber('+39 phone'));
var_dump($satispay->getUserHandler()->create(new User(null, '+39 phone')));