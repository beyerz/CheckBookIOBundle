<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 18/12/2016
 * Time: 11:08
 */

namespace Beyerz\CheckBookIOBundle\Model\Charge;


class ChargeEntity implements \JsonSerializable
{
    const KEY_AMOUNT = 'amount';
    const KEY_TOKEN = 'token';

    /**
     * @var double
     * the amount returned by the callback
     * Required
     */
    private $amount;

    /**
     * @var string
     * The token returned by the callback
     */
    private $token;

    /**
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return $this
     * The amount will be converted to cents
     */
    public function setAmount($amount)
    {
        $this->amount = $amount * 100;
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
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
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
            self::KEY_AMOUNT =>     $this->getAmount(),
            self::KEY_TOKEN =>      $this->getToken(),
        ];
    }
}