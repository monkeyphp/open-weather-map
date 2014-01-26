<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\Hydrator\Strategy;

use OpenWeatherMap\Entity\Current;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
/**
 * Description of CurrentStrategy
 *
 * @author David White <david@monkeyphp.com>
 */
class CurrentStrategy implements StrategyInterface
{
    protected $hydrator;
    
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $hydrator = new ClassMethods();
            $hydrator->addStrategy("city",          new CityStrategy());
            $hydrator->addStrategy('temperature',   new TemperatureStrategy());
            $hydrator->addStrategy('humidity',      new HumidityStrategy());
            $hydrator->addStrategy('pressure',      new PressureStrategy());
            $hydrator->addStrategy('wind',          new WindStrategy());
            $hydrator->addStrategy('clouds',        new CloudsStrategy());
            $hydrator->addStrategy('precipitation', new PrecipitationStrategy());
            $hydrator->addStrategy('weather',       new WeatherStrategy());
            $hydrator->addStrategy('lastupdate',    new LastUpdateStrategy());
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
    }

        
    public function extract($value)
    {
        
    }

    public function hydrate($value)
    {
        if (! is_array($value)) {
            return null;
        }
        return $this->getHydrator()->hydrate($value, new Current());
    }

}
