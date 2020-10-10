# nova-log-cleaner
Nova Log Cleaner Card

## Installation:

You can install the package in to a Laravel app that uses Nova via composer:

```bash
composer require amidesfahani/nova-log-cleaner
```

## Usage:
file: app/Providers/NovaServiceProvder.php

```php
namespace App\Providers;

[...]
class NovaServiceProvider extends NovaApplicationServiceProvider
{

[...]

  public function card()
  {
      return [
        (new \Amidesfahani\NovaLogCleaner\NovaLogCleaner())->width('1/3'),
      ];
  }

[...]

}

```

## License:
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
