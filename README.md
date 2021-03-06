[![Packagist](https://img.shields.io/packagist/v/beyerz/check-book-io-bundle.svg)](https://packagist.org/packages/beyerz/check-book-io-bundle)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://travis-ci.org/beyerz/CheckBookIOBundle.svg?branch=master)](https://travis-ci.org/beyerz/CheckBookIOBundle)
# CheckBookIOBundle
The CheckBookIOBundle provides symfony support for [checkbook.io](https://www.checkbook.io/) API.

# Installation
### Composer

    composer require beyerz/check-book-io-bundle

### Application Kernel

Add SimpleHMVC to the `registerBundles()` method of your application kernel:

```php
public function registerBundles()
{
    return array(
        new Beyerz\CheckBookIOBundle\CheckBookIOBundle(),
    );
}
```

### Config
config.yml
```yaml
check_book_io:
    publishable_key:  "%checkbook_publishable_key%"       # public_key
    secret_key:       "%checkbook_secret_key%"            # private_key
    sandbox:          "%checkbook_sandbox%"               # use sandbox mode
    debug:            "%checkbook_debug%"                 # use debug mode
    merchant_name:    "%checkbook_merchant_name%"         # merchant name to use
    oauth:
      client_id:      "%checkbook_oauth_client_id%"
      handler:        path\to\custom\response\handler
```

# Documentation
Using the bundle is extremely simple...
anywhere that has access to container and services
```php
$checkBook = $this->getContainer()->get('checkbook.model');
```
Boom!! You now have a facade to access all the Checkbook API Endpoints.

### OAuth

[Explained in detail here](Docs/OAuth.md)

### Bonus Feature
Embedded form check

To use the embeded form check you should populate the ```Beyerz\CheckBookIOBundle\Context\EmbeddedCheckContext``` and pass it to your twig template.
Then use ```{{ embedded_check(context) }}``` where context is the ```Beyerz\CheckBookIOBundle\Context\EmbeddedCheckContext```
This will automatically generate the checkbook button.

## License
This bundle is under the MIT license. See the complete license [in the bundle](LICENSE)
## Reporting an issue or feature request
Issues and feature requests are tracked in the [Github issue tracker](https://github.com/beyerz/CheckBookIOBundle/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project built using the [Symfony Standard Edition](https://github.com/symfony/symfony-standard) to allow developers of the bundle to reproduce the issue by simply cloning it and following some steps.

# Disclaimer
Other than being a client, I have no connection to or with checkbookIO or any of its employees.
Furthermore, the bundle comes as is and I cannot guarantee that the bundle will be updated with any changes that
 are done by checkbook, and if updates are done, how long they will take to be implemented and released.
 Like it or leave, but that's the reality.
 Enjoy and Play Safe!!
