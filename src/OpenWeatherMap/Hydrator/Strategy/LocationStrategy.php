<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Hydrator\Strategy;

use OpenWeatherMap\Entity\Location;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * Description of LocationStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class LocationStrategy implements StrategyInterface
{
    
    protected $hydrator;
    
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $this->hydrator = new ClassMethods();
        }
        return $this->hydrator;
    }
    
    public function extract($value)
    {
        
    }

    public function hydrate($value)
    {
        if (isset($value['location']) && is_array($value['location'])) {
            $value += $value['location'];
            unset($value['location']);
        }
        
        if (isset($value['geobaseId'])) {
            $value['geobaseId'] = $value['geobaseid'];
            unset($value['geobaseid']);
        }
        
        return $this->getHydrator()->hydrate($value, new Location());
    }

}
