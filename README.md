## PHP Faucetpay API Client

This is a PHP package for the [Faucetpay](https://faucetpay.io/) API. It provides an easy-to-use interface for interacting with the Faucetpay API, which allows you to send and receive cryptocurrency payments.

### Installation

To use this package, you can install it via composer:

```
composer require firdavs/faucetpay
```

For public all vendor config file:

```
php artisan vendor:publish --provider="Firdavs\FaucetPackageServiceProvider" --tag="config"
```

Add env file faucetpay api key:

```
FAUCETPAY_API_KEY=your_api
```

### Usage

First, you need to create an instance of the `Firdavs\Faucetpay` class:

```php
use Firdavs\Faucetpay;

$faucetpay = new Faucetpay();
```

By default, the constructor will use the `test123465` API key and `BTC` cryptocurrency. You can override these values by specifying them in the `config/faucetpay.php` file in your Laravel application.

#### Get Balance

You can get the balance of your Faucetpay account by calling the `getBalance` method:

```php
$balance = $faucetpay->getBalance();
```

By default, it will return the balance of the `BTC` cryptocurrency. You can specify a different cryptocurrency by passing its symbol as a parameter:

```php
$balance = $faucetpay->getBalance('ETH');
```

#### List of All Crypto

You can get a list of all cryptocurrencies supported by Faucetpay by calling the `currencies` method:

```php
$currencies = $faucetpay->currencies();
```

#### Check Address

You can check if a given address belongs to a Faucetpay user by calling the `checkAddress` method:

```php
$address = '...'; // Replace with the address you want to check
$result = $faucetpay->checkAddress($address);
```

#### Send Payment

You can send cryptocurrency payments to any Faucetpay address by calling the `send` method:

```php
$address = '...'; // Replace with the address you want to send to
$amount = 0.001; // Replace with the amount you want to send
$result = $faucetpay->send($address, $amount);
```

By default, it will send a payment in the `BTC` cryptocurrency. You can specify a different cryptocurrency by passing its symbol as a third parameter:

```php
$result = $faucetpay->send($address, $amount, 'ETH');
```

#### List of Recent Transactions

You can get a list of your recent transactions by calling the `transactions` method:

```php
$transactions = $faucetpay->transactions();
```

### Credits

This package was created by [Firdavs Sharipov](https://github.com/firdavs9512).
