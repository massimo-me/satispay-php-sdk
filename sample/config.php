<?php

include __DIR__ . '/../vendor/autoload.php';

use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_m3pn3f4u02bqdbfbc56bjetub0lk1fm75le69ihokngjnj32o7kjod9ipk9fosgjgo31ujtmo1k55n8gekk95ncf9qvnnj86ck6s0lcvl8aubdmcjq9en6tn1bup99svlrulaejj0b4u290qqhg3p8raqqtamjm5bun1dnmea2imjrvo2hdd9re9cb33vmd5f3fe1mc8'),
    'sandbox'
);