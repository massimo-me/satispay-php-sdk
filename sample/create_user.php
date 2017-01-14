<?php

include 'config.php';

use ChiarilloMassimo\Satispay\Model\User;

//Return ChiarilloMassimo\Satispay\Model\User
var_dump($satispay->getUserHandler()->createByPhoneNumber('+39 phone'));

$user = new User(null, '+39 phone');
var_dump($satispay->getUserHandler()->persist($user));