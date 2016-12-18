<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 18/12/2016
 * Time: 11:08
 */

namespace Beyerz\CheckBookIOBundle\Model\Check;


class CreateCheckEntity implements \JsonSerializable
{
    const KEY_AMOUNT = 'amount';
    const KEY_RECIPIENT = 'recipient';
    const KEY_BUSINESS = 'business';
    const KEY_CHECK_NUMBER = 'check_number';
    const KEY_DESCRIPTION = 'description';
    const KEY_FIRST_NAME = 'first_name';
    const KEY_LAST_NAME = 'last_name';
    /**
     * @var double
     * Amount for check
     * Required
     */
    private $amount;

    /**
     * @var string
     * Recipient’s business name
     * Optional
     */
    private $business;

    /**
     * @var integer
     * Check number for check
     * Optional
     */
    private $checkNumber;

    /**
     * @var string
     * Message to appear in the memo field
     * Optional
     */
    private $description;

    /**
     * @var string
     * Recipient’s first name
     * Optional
     */
    private $firstName;

    /**
     * @var string
     * Recipient’s last name
     * Optional
     */
    private $lastName;

    /**
     * @var string
     * Recipient’s email address
     * Required
     */
    private $recipient;

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return CreateCheckEntity
     */
    public function setAmount($amount)
    {
        $this->amount = (double)$amount;
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
     * @return CreateCheckEntity
     */
    public function setBusiness($business)
    {
        $this->business = $business;
        return $this;
    }

    /**
     * @return int
     */
    public function getCheckNumber()
    {
        return $this->checkNumber;
    }

    /**
     * @param int $checkNumber
     * @return CreateCheckEntity
     */
    public function setCheckNumber($checkNumber)
    {
        $this->checkNumber = $checkNumber;
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
     * @return CreateCheckEntity
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return CreateCheckEntity
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
     * @return CreateCheckEntity
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
     * @return CreateCheckEntity
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            self::KEY_AMOUNT =>         $this->getAmount(),
            self::KEY_RECIPIENT =>      $this->getRecipient(),
            self::KEY_BUSINESS =>       $this->getBusiness(),
            self::KEY_CHECK_NUMBER =>   $this->getCheckNumber(),
            self::KEY_DESCRIPTION =>    $this->getDescription(),
            self::KEY_FIRST_NAME =>     $this->getFirstName(),
            self::KEY_LAST_NAME =>      $this->getLastName(),
        ];
    }
}