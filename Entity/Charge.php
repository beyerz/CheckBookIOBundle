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
    const DATE_FORMAT = 'd M Y';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $checkId;

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
     * @var string
     */
    private $error;

    /**
     * Check constructor.
     * @param ParameterBag $parameters
     */
    public function __construct(ParameterBag $parameters)
    {
        $this->setId($parameters->get('id'))
            ->setCheckId($parameters->get('check_id'))
            ->setToken($parameters->get('token'))
            ->setStatus($parameters->get('status'))
            ->setMessage($parameters->get('message'))
            ->setError($parameters->get('error', 'no errors'));
        if($parameters->get('status') == "SUCCESS") {
            $this->setDate(\DateTime::createFromFormat(self::DATE_FORMAT, $parameters->get('created')));
        }
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
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Charge
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getCheckId()
    {
        return $this->checkId;
    }

    /**
     * @param string $checkId
     * @return Charge
     */
    public function setCheckId($checkId)
    {
        $this->checkId = $checkId;
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

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return Charge
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    public function serialize()
    {
        return [
            'token'         => $this->getToken(),
            'id'            => $this->getId(),
            'check_id'      => $this->getCheckId(),
            'created'       => ($this->getDate() instanceof \DateTime)?$this->getDate()->format(self::DATE_FORMAT):$this->getDate(),
            'status'        => $this->getStatus(),
            'message'       => $this->getMessage(),
            'error'         => $this->getError(),
        ];
    }
}