<?php

include __DIR__ . '/../vendor/autoload.php';

use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_...'),
    'sandbox'
);

//Return ChiarilloMassimo\Satispay\Model\User
var_dump($satispay->getUserHandler()->get('{id}'));