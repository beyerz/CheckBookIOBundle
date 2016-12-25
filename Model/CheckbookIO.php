<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:04
 */

namespace Beyerz\CheckBookIOBundle\Model;


use Beyerz\CheckBookIOBundle\Model\Charge\Charge;
use Beyerz\CheckBookIOBundle\Model\Check\Check;
use Beyerz\CheckBookIOBundle\Model\Invoice\Invoice;
use Beyerz\CheckBookIOBundle\Model\Oauth\Oauth;
use Beyerz\CheckBookIOBundle\Model\Subscription\Subscription;

class CheckbookIO
{
    /**
     * @var Check
     */
    private $check;

    /**
     * @var Invoice
     */
    private $invoice;

    /**
     * @var Subscription
     */
    private $subscription;

    /**
     * @var Charge
     */
    private $charge;

    /**
     * @var Oauth
     */
    private $oauth;

    /**
     * CheckbookIO constructor.
     * @param Check $check
     * @param Invoice $invoice
     * @param Subscription $subscription
     * @param Charge $charge
     * @param Oauth $oauth
     */
    public function __construct(Check $check, Invoice $invoice, Subscription $subscription, Charge $charge, Oauth $oauth)
    {
        $this->check = $check;
        $this->invoice = $invoice;
        $this->subscription = $subscription;
        $this->charge = $charge;
        $this->oauth = $oauth;
    }

    /**
     * @return Check
     */
    public function check(){
        return $this->check;
    }

    /**
     * @return Invoice
     */
    public function invoice(){
        return $this->invoice;
    }

    /**
     * @return Subscription
     */
    public function subscription(){
        return $this->subscription;
    }

    /**
     * @return Charge
     */
    public function charge(){
        return $this->charge;
    }

    /**
     * @return Oauth
     */
    public function oauth(){
        return $this->oauth;
    }
}