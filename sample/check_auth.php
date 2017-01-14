<?php

include 'config.php';

echo $satispay->getBearerHandler()->isAuthorized();
