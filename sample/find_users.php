<?php

include 'config.php';

//Return ChiarilloMassimo\Satispay\Model\ArrayCollection
var_dump($satispay->getUserHandler()->find());
var_dump($satispay->getUserHandler()->find(50, 'starting_id', 'ending_id'));

$users = $satispay->getUserHandler()->find();

foreach ($users as $user) {
    var_dump($user->getPhoneNumber());
}