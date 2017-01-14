#Satispay PHP SDK

- [X] Check Bearer
- [X] Users
- [X] Charges
- [ ] Daily closure (@WIP)
- [ ] Refunds

#Install
[Download composer](https://getcomposer.org/download)

`$ composer install`

Don't break your code, since it's a development version. The stable version will be published on https://packagist.org/

##API: Init

```php
use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_...'),
    'sandbox'
);
```

##API: Check Bearer

###Check Authorization

```php
if ($satispay->getBearerHandler()->isAuthorized()) {
 ....
};
```

##API: Users

###Creation

```php
$satispay->getUserHandler()->createByPhoneNumber('+39 yourphone')
$satispay->getUserHandler()->persist(new User(null, '+39 yourphone'))
```

###Get

```php
$satispay->getUserHandler()->findOneById('id')
```

###Find

```php
$satispay->getUserHandler()->find()
$satispay->getUserHandler()->find(50, 'starting_id', 'ending_id')

$users = $satispay->getUserHandler()->find();

foreach ($users as $user) {
    //...
}
```

##API: Charge

###Create

```php
use ChiarilloMassimo\Satispay\Model\Charge;

$charge = new Charge();

$user = $satispay->getUserHandler()->createByPhoneNumber('+39 yourphone');

$charge
    ->setUser($user)
    ->setAmount(15) // 0.15 €
    ->setCallbackUrl('http://fakeurl.com/satispay-callback')
    ->setCurrency('EUR')
    ->setDescription('Test description')
    ->setExpireMinutes(20)
    ->setExtraFields([
        'orderId' => 'id',
        'extra' => 'extra'
    ])
    ->setSendMail(false);
    
$satispay->getChargeHandler()->persist($charge, true);

$charge->isPaid(); //false
$charge->getStatus(); //Charge::STATUS_REQUIRED
```

###Get

```php
$satispay->getChargeHandler()->findOneById('charge_id')
```

###Update

```php
$charge = $satispay->getChargeHandler()->findOneById('charge_id')
$charge->setDescription('My fantastic description!!')

$satispay->getChargeHandler()->update($charge)
```

###Find

```php
$satispay->getChargeHandler()->find()
$satispay->getChargeHandler()->find(50, 'starting_id', 'ending_id')

$charges = $satispay->getChargeHandler()->find();

foreach ($charge as $chage) {
    //...
}
```

##API: Daily closure

This feature is in pending

```php
$amount = $satispay->getDailyClosureHandler()->getAmount(new \DateTime('2017/01/01'));
```