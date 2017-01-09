<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 15:22
 */

namespace Beyerz\CheckBookIOBundle\Entity;


use Symfony\Component\HttpFoundation\ParameterBag;

class Check
{
    const DATE_FORMAT_NEW = 'Y-m-d H:i:s.u';
    const DATE_FORMAT_OLD = 'Y-m-d H:i:s';
    const DATE_DISPLAY_FORMAT = 'Y-m-d H:i:s';

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
    private $checkNum;

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
     * @param ParameterBag $parameters
     */
    public function __construct(ParameterBag $parameters)
    {
        $this->setId($parameters->get('id'))
            ->setCheckNum($parameters->get('check_num'))
            ->setDescription($parameters->get('description'))
            ->setStatus($parameters->get('status'))
            ->setAmount($parameters->get('amount'))
            ->setToken($parameters->get('token'))
            ->setPaid($parameters->get('paid'))
            ->setAddress($parameters->get('address'))
            ->setName($parameters->get('name'));
        $format = strpos($parameters->get('date'),'.') == true?self::DATE_FORMAT_NEW:self::DATE_FORMAT_OLD;
        $this->setDate(\DateTime::createFromFormat($format, $parameters->get('date')));
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
        return $this->checkNum;
    }

    /**
     * @param int $checkNum
     * @return Check
     */
    public function setCheckNum($checkNum)
    {
        $this->checkNum = $checkNum;
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

    public function serialize()
    {
        return [
            'id'            => $this->getId(),
            'date'          => $this->getDate()->format(self::DATE_DISPLAY_FORMAT),
            'checkNum'      => $this->getCheckNum(),
            'description'   => $this->getDescription(),
            'status'        => $this->getStatus(),
            'amount'        => $this->getAmount(),
            'token'         => $this->getToken(),
            'paid'          => $this->getPaid(),
            'addressed_to'  => $this->getAddress(),
            'name'          => $this->getName(),
        ];
    }
}