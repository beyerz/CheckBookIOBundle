<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:04
 */

namespace Beyerz\CheckBookIOBundle\Model;


use Beyerz\CheckBookIOBundle\Model\Check\Check;
use Beyerz\CheckBookIOBundle\Model\Invoice\Invoice;
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
     * CheckbookIO constructor.
     * @param Check $check
     * @param Invoice $invoice
     * @param Subscription $subscription
     */
    public function __construct(Check $check, Invoice $invoice, Subscription $subscription)
    {
        $this->check = $check;
        $this->invoice = $invoice;
        $this->subscription = $subscription;
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


}