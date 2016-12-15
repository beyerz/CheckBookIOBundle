<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:21
 */

namespace Beyerz\CheckBookIOBundle\Gateway\Invoice\Create;


class Request
{

    const URI = '/v2/invoice';
    const METHOD = 'POST';

    /**
     * @var float
     */
    private $amount;        //|Required   |Amount for invoice

    /**
     * @var string
     */
    private $attachment;    //|Optional   |Base64 encoded PDF file (included in invoice email)

    /**
     * @var string
     */
    private $business;      //|Optional   |Recipient’s business name

    /**
     * @var string
     */
    private $description;   //|Required   |Description field for invoice

    /**
     * @var string
     */
    private $email;         //|Required   |Recipient’s email address

    /**
     * @var string
     */
    private $firstName;    //|Optional   |Recipient’s first name

    /**
     * @var string
     */
    private $lastName;     //|Optional   |Recipient’s last name

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Request
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param string $attachment
     * @return Request
     */
    public function setAttachment($attachment)
    {
        //TODO: Auto base64 Encode and convert to pdf file
        $this->attachment = $attachment;
        return $this;
    }

    /**
     * @return string
     */
    public function getBusiness()
    {
        return $this->business;
    }

    /**
     * @param string $business
     * @return Request
     */
    public function setBusiness($business)
    {
        $this->business = $business;
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
     * @return Request
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
     * @return Request
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Request
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Request
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
}