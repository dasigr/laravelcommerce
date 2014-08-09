<?php namespace Dasigr\Commerce;

use Dasigr\Commerce\Exception\InvalidCurrecncyException;

class Money {

    /**
     * The fractional unit of the value
     *
     * @var int
     */
    protected $fractional;

    /**
     * The currency of the value
     *
     * @var Dasigr\Commerce\Currency
     */
    protected $currency;

    /**
     * Create a new instance of Money
     *
     * @param int $fractional
     * @param Dasigr\Commerce\Currency $currency
     * @return void
     */
    public function __construct($fractional, Currency $currency)
    {
        $this->fractional = $fractional;
        $this->currency = $currency;
    }
    
    /**
     * A static function to create a new instance of Money.
     * 
     * @param type $value
     * @param type $currency
     * @return Dasigr\Commerce\Money
     */
    public static function init($value, $currency)
    {
        return new Money($value, new Currency($currency));
    }
    
    /**
     * Get the fractional value of the object
     * 
     * @return int
     */
    public function getCentsParamerer()
    {
        return $this->fractional;
    }
    
    /**
     * Get the Currency object
     * 
     * @return Dasigr\Commerce\Currency
     */
    public function getCurrencyParameter()
    {
        return $this->currency;
    }
    
    /**
     * Magic method to dynamically get object parameters
     * 
     * @param type $param
     * @return mixed
     */
    public function __get($param)
    {
        $method = 'get'.ucfirst($param).'Parameter';
        
        if (method_exists($this, $method))
            return $this->{$method}();
    }
    
    /**
     * Check the Iso code to evaluate the equality fo the currency
     * 
     * @param \Dasigr\Commerce\Money $money
     * @return bool
     */
    public function isSameCurrency(Money $money)
    {
        return $this->currency->getIsoCode() == $money->currency->getIsoCode();
    }
    
    /**
     * Check the equality of two Money objects.
     * First check the currency and then check the value.
     * 
     * @param \Dasigr\Commerce\Money $money
     * @return bool
     */
    public function equals(Money $money)
    {
        return $this->isSameCurrency($money) && $this->cents == $money->cents;
    }
    
    /**
     * Add the value of two Money objects and return a new Money object.
     * 
     * @param \Dasigr\Commerce\Money $money
     * @return \Dasigr\Commerce\Money
     * @throws InvalidCurrecncyException
     */
    public function add(Money $money)
    {
        if ($this->isSameCurrency($money))
        {
            return Money::init($this->cents + $money->cents, $this->currency->getIsoCode());
        }
        
        throw new InvalidCurrecncyException("You can't add two Money objects with different currencies");
    }
    
    /**
     * Subtract the value of one Money object from another and return a new Money object
     * 
     * @param Dasigr\Commerce\Money $money
     * @return Dasigr\Commerce\Money
     * @throws InvalidCurrecncyException
     */
    public function substract(Money $money)
    {
        if ($this->isSameCurrency($money))
        {
            return Money::init($this->cents - $money->cents, $this->currency->getIsoCode());
        }
        
        throw new InvalidCurrecncyException("You can't subtract two Money objects with different currencies");
    }
    
    /**
     * Multiply two Money objects together and return a new Money object
     * 
     * @param int $number
     * @return Dasigr\Commerce\Money
     */
    public function multiply($number)
    {
        return Money::init((int) round($this->cents * $number, 0, PHP_ROUND_HALF_EVEN), $this->currency->getIsoCode());
    }
    
    /**
     * Divide one Money object and return a new Money object
     * 
     * @param int $number
     * @return Dasigr\Commerce\Money
     */
    public function divide($number)
    {
        return Money::init((int) round($this->cents / $number, 0, PHP_ROUND_HALF_EVEN), $this->currency->getIsoCode());
    }

}
