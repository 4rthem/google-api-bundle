# Google API Bundle

Symfony bundle for [google-api](https://github.com/4rthem/google-api)

## Installation

This is installable via [Composer](https://getcomposer.org/) as [arthem/google-api-bundle](https://packagist.org/packages/arthem/google-api-bundle):

```bash
composer require arthem/google-api-bundle
```

## Setup / Configuration

Enable the bundle:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Arthem\Bundle\GoogleApiBundle\ArthemGoogleApiBundle(),
        );

        // ...
    }

    // ...
}
```

## License

Released under the [MIT License](LICENSE).
