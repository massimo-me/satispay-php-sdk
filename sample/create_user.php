<?php

include 'config.php';

use ChiarilloMassimo\Satispay\Model\User;

//Return ChiarilloMassimo\Satispay\Model\User
$satispay->getUserHandler()->createByPhoneNumber('+39 phone');

$user = new User(null, '+39 phone');
$satispay->getUserHandler()->persist($user);
