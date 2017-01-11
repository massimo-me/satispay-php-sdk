<?php

include __DIR__ . '/../vendor/autoload.php';

use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_k31hjn74vg4ho09hom7qetb9482dbs6inv8nmct7srgqtpsuaqjhur5t4tr09iqrsjt9d1tapcblh3htbrnj1jp6cic027gbhov6h038rbgqh411b5u1b4sittr1fgc14md5kt36lmd1pmuoqi16h11escvapfg8ujd6b3s00anpqtemb0rbcu8lk8fcei9jb74pkc2b'),
    'sandbox'
);

//Return ChiarilloMassimo\Satispay\Model\User
var_dump($satispay->getUserHandler()->create('+39 yourphone'));