<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Hydrator\Strategy;

use OpenWeatherMap\Entity\Forecast;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * Description of ForecastStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class ForecastStrategy implements StrategyInterface
{
    protected $hydrator;
    
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $hydrator = new ClassMethods();
            $hydrator->addStrategy('times', new TimesStrategy());
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
    }
    
    public function extract($value)
    {
        
    }

    public function hydrate($value)
    {
        if (isset($value['time']) && is_array($value['time'])) {
            $value['times'] = $value['time'];
            unset($value['time']);
        }
        return $this->getHydrator()->hydrate($value, new Forecast());
    }
}
