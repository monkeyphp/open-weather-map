<?php
/**
 * CurrentStrategy.php
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 * 
 * Copyright (C) 2014  David White
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see [http://www.gnu.org/licenses/].
 */
namespace OpenWeatherMap\Hydrator\Strategy;

use OpenWeatherMap\Entity\Current;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * CurrentStrategy
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class CurrentStrategy implements StrategyInterface
{
    /**
     * Instance of ClassMethods
     * 
     * @var ClassMethods
     */
    protected $hydrator;
    
    /**
     * Return an instance of ClassMethods
     * 
     * @return ClassMethods
     */
    protected function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $hydrator = new ClassMethods();
            $hydrator->addStrategy("city",          new CityStrategy());
            $hydrator->addStrategy('temperature',   new TemperatureStrategy());
            $hydrator->addStrategy('humidity',      new HumidityStrategy());
            $hydrator->addStrategy('pressure',      new PressureStrategy());
            $hydrator->addStrategy('windSpeed',     new WindSpeedStrategy());
            $hydrator->addStrategy('windDirection', new WindDirectionStrategy());
            $hydrator->addStrategy('clouds',        new CloudsStrategy());
            $hydrator->addStrategy('precipitation', new PrecipitationStrategy());
            $hydrator->addStrategy('weather',       new WeatherStrategy());
            //$hydrator->addStrategy('lastupdate',    new LastUpdateStrategy());
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
    }

    /**
     * Extract and return an array of values from the supplied Current
     * 
     * @param Current $value The instance of Current to extract
     * 
     * @return null|array
     */ 
    public function extract($value)
    {
        if (! $value instanceof Current) {
            return null;
        }
        return $this->getHydrator()->extract($value);
    }

    /**
     * Hydrate and return an instance of Current 
     * 
     * @param array $value
     * 
     * @return Current|null
     */
    public function hydrate($value)
    {
        if (! is_array($value)) {
            return null;
        }
        if (isset($value['wind'])) {
            $wind = $value['wind'];
            if (isset($wind['speed'])) {
                $value['windSpeed'] = $wind['speed'];
            }
            if (isset($wind['direction'])) {
                $value['windDirection'] = $wind['direction'];
            }
            unset($value['wind']);
        }
        if (isset($value['lastupdate']) && is_array($value['lastupdate'])) {
            $lastUpdate = $value['lastupdate'];
            if (isset($lastUpdate['value'])) {
                $value['lastUpdate'] = $lastUpdate['value'];
                unset($value['lastupdate']);
            }
        }
        return $this->getHydrator()->hydrate($value, new Current());
    }
}
