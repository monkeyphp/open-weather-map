<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Hydrator\Strategy;
/**
 * Description of CloudsStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class CloudsStrategy  implements \Zend\Stdlib\Hydrator\Strategy\StrategyInterface
{
    protected $hydrator;
    
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $this->hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        }
        return $this->hydrator;
    }
    
    public function extract($value)
    {
        return $this->getHydrator()->extract($value);
    }

    public function hydrate($value)
    {
        return $this->getHydrator()->hydrate($value, new \OpenWeatherMap\Entity\Clouds());
    }

}
