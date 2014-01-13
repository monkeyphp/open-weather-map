<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
/**
 * Description of CityStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class CityStrategy implements StrategyInterface
{
    protected $hydrator;
    
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $hydrator = new ClassMethods();
            $hydrator->addStrategy('coord', new CoordStrategy());
            $hydrator->addStrategy('sun', new SunStrategy());
            $this->hydrator = $hydrator;
            
        }
        return $this->hydrator;
    }
    
    /**
      * Converts the given value so that it can be extracted by the hydrator.
      *
      * @param mixed $value The original value.
      * 
      * @return mixed Returns the value that should be extracted.
      */
    public function extract($value)
    {
        return $this->getHydrator()->extract($value);
    }
    
    /**
     * Takes array and populates object
     * 
      * Converts the given value so that it can be hydrated by the hydrator.
      *
      * @param mixed $value The original value.
      * @return mixed Returns the value that should be hydrated.
      */
    public function hydrate($value)
    {
        return $this->getHydrator()->hydrate($value, new \OpenWeatherMap\Entity\City());
    }

}
