#Satispay PHP SDK

- [X] Check Bearer
- [ ] Users
- [ ] Charges
- [ ] Daily closure
- [ ] Refunds

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

