# ApiProvider

Api Provider for Laravel 5

## Installation

Add `yvolkan/apiprovider` to `composer.json`.
```
"yvolkan/apiprovider": "~1.0"
```

Run `composer update` to pull down the latest version of ApiProvider.

Or run
```
composer require yvolkan/apiprovider
```

Now open up `/config/app.php` and add the service provider to your `providers` array.
```php
'providers' => [
	yvolkan\ApiProvider\ApiProviderServiceProvider::class,
]
```

Now add the alias.
```php
'aliases' => [
	'ApiProvider' => yvolkan\ApiProvider\Facades\ApiProvider::class,
]
```
