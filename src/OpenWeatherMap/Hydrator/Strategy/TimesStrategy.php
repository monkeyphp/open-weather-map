<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OpenWeatherMap\Hydrator\Strategy;

use OpenWeatherMap\Entity\Time;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * Description of TimeStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class TimesStrategy implements StrategyInterface
{
    protected $hydrator;
    
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $hydrator = new ClassMethods();
            $hydrator->addStrategy('symbol', new SymbolStrategy());
            $hydrator->addStrategy('precipitation', new PrecipitationStrategy());
            $hydrator->addStrategy('windDirection', new WindDirectionStrategy());
            $hydrator->addStrategy('windSpeed', new WindSpeedStrategy());
            $hydrator->addStrategy('temperature', new TemperatureStrategy());
            $hydrator->addStrategy('pressure', new PressureStrategy());
            $hydrator->addStrategy('humidity', new HumidityStrategy());
            $hydrator->addStrategy('clouds', new CloudsStrategy());
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
    }
    
    public function extract($value)
    {
        
    }

    public function hydrate($value)
    {
        $times = array();
        if (is_array($value)) {
            foreach ($value as $data) {
                $times[] = $this->getHydrator()->hydrate($data, new Time());
            }
        }
        return $times;
    }
}
