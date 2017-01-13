#Satispay PHP SDK

- [X] Check Bearer
- [X] Users
- [ ] Charges
- [ ] Daily closure
- [ ] Refunds

#Install
[Download composer](https://getcomposer.org/download)

`$ composer install`

Don't break your code, since it's a development version. The stable version will be published on https://packagist.org/

#API: Init

```php
use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_...'),
    'sandbox'
);
```

###API: Check Bearer

```php
if ($satispay->getBearerHandler()->isAuthorized()) {
 ....
};
```

###API: Users

###Creation

```php
$satispay->getUserHandler()->create('+39 yourphone')
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
    var_dump($user->getPhoneNumber());
}
```
