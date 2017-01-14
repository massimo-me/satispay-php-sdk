<?php

include 'config.php';

$refund = $satispay->getRefundHandler()->findOneById('refund_id');

$refund->setDescription('My fantastic description!!');

$satispay->getRefundHandler()->update($refund);

var_dump($refund->getDescription());