## The purpose of this fork was to convert the original repository to PHP8. 
 I now recommend using the official SDK: https://github.com/comgate-payments/sdk-php/

# Comgate API client for PHP >= 8
Comgate API client wrapper

This package allow you to create payment using Comgate API and get redirect URL to your customers

Requirements
-------------
- PHP 8.0 or higher
- [guzzlehttp/guzzle](https://packagist.org/packages/guzzlehttp/guzzle)

Installation
------------
```sh
$ composer require renat-magadiev/comgate-client
```


Basic usage
------------

```php
use Comgate\Client;
use Comgate\Request\CreatePayment;

$client = new Client('merchant', true, 'secret');
$createPayment = new CreatePayment(1000, 'orderId', 'test@test.cz', 'Product name');

$createPaymentResponse = $client->send($createPayment);

$redirectUrl = $createPaymentResponse->getRedirectUrl();

```

`CreatePayment` class has the same props as described in Comgate [documentation](https://platebnibrana.comgate.cz/cz/protokol-api#sidemenu-link-12)
