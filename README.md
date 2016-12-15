# CheckBookIOBundle
The CheckBookIOBundle provides symfony support for [checkbook.io](https://www.checkbook.io/) API.

# Documentation
Using the bundle is extremely simple... nuff said

# Config
config.yml
```yaml
check_book_io:
    publishable_key:  "%checkbook_publishable_key%"       # public_key
    secret_key:       "%checkbook_secret_key%"            # private_key
    sandbox:          "%checkbook_sandbox%"               # use sandbox mode
```
## Installation
### Composer

    composer require beyerz/beyerz/check-book-io-bundle

### Application Kernel

Add SimpleHMVC to the `registerBundles()` method of your application kernel:

    public function registerBundles()
    {
        return array(
            new Beyerz\CheckBookIOBundle\CheckBookIOBundle(),
        );
    }



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