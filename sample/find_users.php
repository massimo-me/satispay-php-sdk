<?php

include 'config.php';

//Return ChiarilloMassimo\Satispay\Model\ArrayCollection
$satispay->getUserHandler()->find(50, 'starting_id', 'ending_id');
$users = $satispay->getUserHandler()->find();

foreach ($users as $user) {
    //..
}
