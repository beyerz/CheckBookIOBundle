<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 15/12/2016
 * Time: 15:22
 */

namespace Beyerz\CheckBookIOBundle\Entity;


use Symfony\Component\HttpFoundation\ParameterBag;

class Charge
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
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $message;

    /**
     * Check constructor.
     * @param ParameterBag $parameters
     */
    public function __construct(ParameterBag $parameters)
    {
        $this->setId($parameters->get('id'))
            ->setDate(\DateTime::createFromFormat('Y-m-d H:i:s.u', $parameters->get('created')))
            ->setStatus($parameters->get('status'))
            ->setMessage($parameters->get('message'));
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
     * @return Charge
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
     * @return Charge
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * @return Charge
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Charge
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function serialize()
    {
        return [
            'id'            => $this->getId(),
            'created'          => $this->getDate()->format('Y-m-d H:i:s'),
            'status'        => $this->getStatus(),
            'message'          => $this->getMessage(),
        ];
    }
}