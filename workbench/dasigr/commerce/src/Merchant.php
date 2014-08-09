<?php namespace Dasigr\Commerce;

use Dasigr\Commerce\Exception\InvalidRegionException;

class Merchant {
    
    public static function order($region)
    {
        $class = 'Dasigr\Commerce\Region\\'.ucfirst($region);
        
        if (class_exists($class))
        {
            return new Order(new $class);
        }
        
        throw new InvalidRegionException("$region is not a valid region");
    }
}
