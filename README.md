#Satispay PHP SDK

- [X] Check Bearer
- [ ] Users
- [ ] Charges
- [ ] Daily closure
- [ ] Refunds

#API: Check Bearer

https://s3-eu-west-1.amazonaws.com/docs.online.satispay.com/index.html#api-check-bearer

```php
use ChiarilloMassimo\Satispay\Authorization\Bearer;
use ChiarilloMassimo\Satispay\Satispay;

$satispay = new Satispay(
    new Bearer('osh_...'),
    'sandbox'
);

if ($satispay->isAuthorized()) {
 ....
};
```

