<?php

include __DIR__ . '/../vendor/autoload.php';

use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_k31hjn74vg4ho09hom7qetb9482dbs6inv8nmct7srgqtpsuaqjhur5t4tr09iqrsjt9d1tapcblh3htbrnj1jp6cic027gbhov6h038rbgqh411b5u1b4sittr1fgc14md5kt36lmd1pmuoqi16h11escvapfg8ujd6b3s00anpqtemb0rbcu8lk8fcei9jb74pkc2b'),
    'sandbox'
);

use ChiarilloMassimo\Satispay\Model\User;

//Return ChiarilloMassimo\Satispay\Model\User
var_dump($satispay->getUserHandler()->createByPhoneNumber('+39 phone'));
var_dump($satispay->getUserHandler()->persist(new User(null, '+39 phone')));