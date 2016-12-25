<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 22/12/2016
 * Time: 15:35
 */

namespace Beyerz\CheckBookIOBundle\EventListener;


use Beyerz\CheckBookIOBundle\Event\OnOauthConnectEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class OnOauthConnectEventListener implements EventSubscriberInterface
{

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [OnOauthConnectEvent::EVENT_NAME => 'handler'];
    }

    /**
     * @param OnOauthConnectEvent $event
     * @return mixed
     */
    abstract public function handler(OnOauthConnectEvent $event);
}