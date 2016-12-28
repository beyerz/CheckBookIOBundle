<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 21/12/2016
 * Time: 16:11
 */

namespace Beyerz\CheckBookIOBundle\Entity;


use Symfony\Component\HttpFoundation\ParameterBag;

class Subscription
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $account;
    /**
     * @var string
     */
    private $address;
    /**
     * @var double
     */
    private $amount;
    /**
     * @var \DateTime
     */
    private $date;
    /**
     * @var string
     */
    private $description;
    /**
     * @var integer
     */
    private $duration;
    /**
     * @var string
     */
    private $interval;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $recipient;
    /**
     * @var array
     */
    private $skipped;
    /**
     * @var string
     */
    private $type;

    /**
     * Check constructor.
     * @param ParameterBag $parameters
     */
    public function __construct(ParameterBag $parameters)
    {
        $this->setId($parameters->get('id'))
            ->setAccount($parameters->get('account'))
            ->setAddress($parameters->get('address'))
            ->setAmount($parameters->get('amount'))
            ->setDate(\DateTime::createFromFormat('Y-m-d H:i:s.u', $parameters->get('date')))
            ->setDescription($parameters->get('description'))
            ->setDuration($parameters->get('duration'))
            ->setInterval($parameters->get('interval'))
            ->setName($parameters->get('name'))
            ->setRecipient($parameters->get('recipient'))
            ->setSkipped($parameters->get('skipped'))
            ->setType($parameters->get('type'));
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Subscription
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param string $account
     * @return Subscription
     */
    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Subscription
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Subscription
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     * @return Subscription
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Subscription
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return Subscription
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return string
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param string $interval
     * @return Subscription
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Subscription
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     * @return Subscription
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return array
     */
    public function getSkipped()
    {
        return $this->skipped;
    }

    /**
     * @param array $skipped
     * @return Subscription
     */
    public function setSkipped($skipped)
    {
        $this->skipped = $skipped;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Subscription
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function serialize()
    {
        return [
            'id' => $this->getId(),
            'account' => $this->getAccount(),
            'address' => $this->getAddress(),
            'amount' => $this->getAmount(),
            'date' => $this->getDate()->format('Y-m-d H:i:s'),
            'description' => $this->getDescription(),
            'duration' => $this->getDuration(),
            'interval' => $this->getInterval(),
            'name' => $this->getName(),
            'recipient' => $this->getRecipient(),
            'skipped' => implode(',',$this->getSkipped()),
            'type' => $this->getType(),
        ];
    }
}