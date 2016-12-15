<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 15:22
 */

namespace Beyerz\CheckBookIOBundle\Entity;


class Check
{


    /**
     * @var string
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var integer
     */
    private $check_num;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $status;

    /**
     * @var double
     */
    private $amount;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $paid;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $name;

    /**
     * Check constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setId($options['id'])
            ->setDate(\DateTime::createFromFormat('Y-m-d H:i:s.u',$options['date']))
            ->setCheckNum($options['check_num'])
            ->setDescription($options['description'])
            ->setStatus($options['status'])
            ->setAmount($options['amount'])
            ->setToken(isset($options['token'])?$options['token']:null)
            ->setPaid(isset($options['paid'])?$options['paid']:null)
            ->setAddress($options['address'])
            ->setName($options['name']);
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
     * @return Check
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Check
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getCheckNum()
    {
        return $this->check_num;
    }

    /**
     * @param int $check_num
     * @return Check
     */
    public function setCheckNum($check_num)
    {
        $this->check_num = $check_num;
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
     * @return Check
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Check
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @return Check
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Check
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * @param string $paid
     * @return Check
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
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
     * @return Check
     */
    public function setAddress($address)
    {
        $this->address = $address;
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
     * @return Check
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}