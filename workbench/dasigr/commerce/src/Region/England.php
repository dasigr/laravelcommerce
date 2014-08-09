<?php namespace Dasigr\Commerce\Region;

use Dasigr\Commerce\AbstractRegion;
use Dasigr\Commerce\RegionInterface;

class England extends AbstractRegion implements RegionInterface {
    
    /**
     * @var string
     */
    protected $name = 'England';
    
    /**
     * @var string
     */
    protected $currency = 'GBP';
    
    /**
     * @var boolean
     */
    protected $tax = true;
    
    /**
     * @var integer
     */
    protected $taxRate = 20;
}
