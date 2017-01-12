<?php

include __DIR__ . '/../vendor/autoload.php';

use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_...'),
    'sandbox'
);

//Return ChiarilloMassimo\Satispay\Model\UserCollection
var_dump($satispay->getUserHandler()->find());
var_dump($satispay->getUserHandler()->find(50, 'starting_id', 'ending_id'));

$users = $satispay->getUserHandler()->find();

foreach ($users as $user) {
    var_dump($user->getPhoneNumber());
}