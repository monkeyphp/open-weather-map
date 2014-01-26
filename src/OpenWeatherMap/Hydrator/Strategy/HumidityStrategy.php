<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Hydrator\Strategy;

use OpenWeatherMap\Entity\Humidity;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
/**
 * Description of HumidityStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class HumidityStrategy implements StrategyInterface
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
        if (! $value instanceof Humidity) {
            return null;
        }
        return $this->getHydrator()->extract($value);
    }

    public function hydrate($value)
    {
        return $this->getHydrator()->hydrate($value, new Humidity());
    }

}
