<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Hydrator\Strategy;
/**
 * Description of newPHPClass
 *
 * @author David White <david@monkeyphp.com>
 */
class CoordStrategy implements \Zend\Stdlib\Hydrator\Strategy\StrategyInterface
{
    protected $hydrator;
    
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
     
            $hydrator->addStrategy('latitude', new LongitudeStrategy());
            $hydrator->addStrategy('longitude', new LongitudeStrategy());
            
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
    }
    
    public function extract($value)
    {
        return $this->getHydrator()->extract($value);
    }
    
    public function hydrate($value)
    {   
        $value['latitude'] = (isset($value['lat'])) ? $value['lat'] : null;
        $value['longitude'] = (isset($value['lon'])) ? $value['lon'] : null;
        
        return $this->getHydrator()->hydrate($value, new \OpenWeatherMap\Entity\Coord());
    }

}
