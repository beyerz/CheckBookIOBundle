# OAuth Documentation

OAuth can sometimes be confusing, but guess what, here its been solved with a simple solution.

## Getting Started

1. Add the Oauth Connect button to your twig template.
2. Create the Oauth response handler to get the result.
3. Define the handler full class name in the config
4. Add the connect route to your main project route

## Example

Adding the button to your view

`Resources\views\sample\oauth_connect.html.twig`
```html
{% extends '::base.html.twig' %}
{% block body %}
    <h1>Checkbook.io Symfony Bundle</h1>
    <h2>OAuth Connect Sample</h2>
    {{ checkbook_connect() }}
{% endblock %}
```

Creating the handler class

`EventListener\CheckBookOauthConnectEventListener.php`
```php
<?php

namespace AcmeBundle\EventListener;


use Beyerz\CheckBookIOBundle\Event\OnOauthConnectEvent;

class CheckBookOauthConnectEventListener extends \Beyerz\CheckBookIOBundle\EventListener\OnOauthConnectEventListener
{

    /**
     * @param OnOauthConnectEvent $event
     * @return mixed
     */
    public function handler(OnOauthConnectEvent $event)
    {
        if($event->getStatus() === "SUCCESS"){
            //Assuming everything went well, here you would get the Oauth token and other required varaibles in the $event
        }else{
            //Assuming everything went terribly wrong, here you can report on this and react to create a resolution
        }
    }
}
```

The config

`app\config\config.yml`
```yaml
check_book_io:
    oauth:
      handler: AcmeBundle\EventListener\CheckBookOauthConnectEventListener
```

The route

`app\config\routing.yml`
```yaml
check_book_io_oauth_connect:
    resource: "@CheckBookIOBundle/Resources/config/connect_route.yml"
```

## How it works
### Twig Extension
Based on the config settings, the twig function automatically builds the button and required parameters that will be sent to checkbook
Please note that if you do not add the OAuth config, this extension will never be created and attempting to use it will result in an `Unknown "checkbook_connect" function.` Error

### Handler
After getting the response from checkbook, we trigger an event that can be caught and handled. Doing it this way allows us to expose this data to you very easily.
The idea is that by providing us the namespace of the handler class and extending you class with our listener, we already build and register the listener within Symfony
so you don't need to worry about the technical details.

This being said, you can choose to build you own listener or listeners for the event as it is a normal symfony event.
See ```Beyerz\CheckBookIOBundle\EventListener\OnOauthConnectEventListener``` for our implementation
Please note that is you build you own listener that does not extend our class, you will also need to register the listener as a service.
see: [Events and Event Listeners](http://symfony.com/doc/current/event_dispatcher.html)

