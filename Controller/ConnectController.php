<?php

namespace Beyerz\CheckBookIOBundle\Controller;

use Beyerz\CheckBookIOBundle\Event\OnOauthConnectEvent;
use Beyerz\CheckBookIOBundle\Model\Oauth\OauthTokenEntity;
use GuzzleHttp\Exception\ClientException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConnectController extends Controller
{

    const TARGET_PATH_KEY = 'beyerz.checkbook.oauth.target_path';
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        if($request->query->has('redirect')){
            if($request->server->has('HTTP_REFERER')) {
                $this->container->get('session')->set(self::TARGET_PATH_KEY, $request->server->get('HTTP_REFERER'));
            }

            $queryParams = [
                'client_id' => $this->getParameter('beyerz.checkbook.oauth.client_id'),
                'response_type' => 'code',
                'scope' => 'check',
                'redirect_uri' => $this->getParameter('beyerz.checkbook.oauth.redirect_uri')
            ];
            $queryString = http_build_query($queryParams);
            $href = sprintf('%s%s%s',$this->getParameter('beyerz.checkbook.sandbox')?'https://sandbox.checkbook.io':'https://checkbook.io','/oauth/authorize?',$queryString);
            return $this->redirect($href, 302);
        }else {

            $authCode = $request->query->get('code');
            $checkbook = $this->get('checkbook.model');

            $entity = new OauthTokenEntity();
            $entity->setClientId($this->getParameter('beyerz.checkbook.oauth.client_id'))
                ->setGrantType('authorization_code')
                ->setScope('check')
                ->setCode($authCode)
                ->setRedirectUri($this->getParameter('beyerz.checkbook.oauth.redirect_uri'))
                ->setClientSecret($this->getParameter('beyerz.checkbook.private_key'));

            try {
                $oauth = $checkbook->oauth()->token($entity);
                $event = new OnOauthConnectEvent($oauth);
                $event->setStatus("SUCCESS");
            } catch (ClientException $e) {
                $event = new OnOauthConnectEvent();
                $event->setStatus("ERROR");
                $event->setMessage($e->getMessage());
            }

            $eventDispatcher = $this->get('event_dispatcher');
            $eventDispatcher->dispatch(OnOauthConnectEvent::EVENT_NAME, $event);

            if ($this->container->get('session')->has(self::TARGET_PATH_KEY)) {
                //set the url based on the link they were trying to access before being authenticated
                $url = $this->container->get('session')->get(self::TARGET_PATH_KEY);

                //remove the session key
                $this->container->get('session')->remove(self::TARGET_PATH_KEY);
            } //if the referrer key was never set, redirect to a default route
            else {
                return $this->redirect('/',302);
            }

            return $this->redirect($url, 302);
        }
    }
}
