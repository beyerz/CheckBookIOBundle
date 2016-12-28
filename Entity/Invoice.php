<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 28/12/2016
 * Time: 11:12
 */

namespace Beyerz\CheckBookIOBundle\Entity;



use Symfony\Component\HttpFoundation\ParameterBag;

class Invoice
{
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
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $id;

    /**
     * @var integer
     */
    private $invoiceNum;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $type;

    /**
     * Invoice constructor.
     * @param ParameterBag $parameters
     */
    public function __construct(ParameterBag $parameters)
    {
        $this->setAmount($parameters->get('amount'))
            ->setDate(\DateTime::createFromFormat('Y-m-d H:i:s.u', $parameters->get('date')))
            ->setDescription($parameters->get('description'))
            ->setEmail($parameters->get('email'))
            ->setId($parameters->get('id'))
            ->setInvoiceNum($parameters->get('invoice_num'))
            ->setName($parameters->get('name'))
            ->setStatus($parameters->get('status'))
            ->setType($parameters->get('type'));
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
     * @return Invoice
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
     * @return Invoice
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
     * @return Invoice
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Invoice
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
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
     * @return Invoice
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getInvoiceNum()
    {
        return $this->invoiceNum;
    }

    /**
     * @param int $invoiceNum
     * @return Invoice
     */
    public function setInvoiceNum($invoiceNum)
    {
        $this->invoiceNum = $invoiceNum;
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
     * @return Invoice
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Invoice
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     * @return Invoice
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function serialize()
    {
        return [
            'amount' => $this->getAmount(),
            'date' => $this->getDate()->format('Y-m-d H:i:s'),
            'description' => $this->getDescription(),
            'email' => $this->getEmail(),
            'id' => $this->getId(),
            'invoice_num' => $this->getInvoiceNum(),
            'name' => $this->getName(),
            'status' => $this->getStatus(),
            'type' => $this->getType(),
        ];
    }
}