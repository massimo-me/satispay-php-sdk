<?php

include 'config.php';

$charge = $satispay->getChargeHandler()->findOneById('charge_id');

$charge->setDescription('My fantastic description!!');

$satispay->getChargeHandler()->update($charge);
