<?php
/**
 * TimeStrategy.php
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

use OpenWeatherMap\Entity\Time;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * TimeStrategy
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class TimeStrategy implements StrategyInterface
{
    /**
     * Instance of ClassMethods hydrator
     *
     * @var ClassMethods
     */
    protected $hydrator;

    /**
     * Return an instance of ClassMethods hydrator
     *
     * @return ClassMethods
     */
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

    /**
     * Extract the values from the supplied instance of Time
     *
     * @param Time $value The Time instance to extract values from
     *
     * @return null
     */
    public function extract($value)
    {
        if (! $value instanceof Time) {
            return null;
        }
        return $this->getHydrator()->extract($value);
    }

    /**
     * Hydrate and return an instance of Time using the supplied value array
     *
     * @param array $value
     *
     * @return Time
     */
    public function hydrate($value)
    {
        if (! is_array($value)) {
            return null;
        }

        // handle the differences between xml and json response
        // day/dt
        if (isset($value['dt'])) {
            $value['day'] = $value['dt'];
            unset($value['dt']);
        }
        // temperature/temp
        if (isset($value['temp'])) {
            $value['temperature'] = $value['temp'];
            unset($value['temp']);
        }
        // pressure
        if (isset($value['pressure']) && ! is_array($value['pressure'])) {
            $pressure = array('value' => $value['pressure']);
            $value['pressure'] = $pressure;
        }
        // humidity
        if (isset($value['humidity']) && ! is_array($value['humidity'])) {
            $humidity = array('value' => $value['humidity']);
            $value['humidity'] = $humidity;
        }

        // speed
        if (isset($value['speed']) && ! is_array($value['speed'])) {
            $value['windSpeed'] = array('mps' => $value['speed']);
            unset($value['speed']);
        }
        // deg
        if (isset($value['deg'])) {
            $value['windDirection'] = array('deg' => $value['deg']);
            unset($value['deg']);
        }
        // clouds
        if (isset($value['clouds'])) {
            $value['clouds'] = array('all' => $value['clouds']);
            unset($value['clouds']);
        }
        // precipitation/rain
        if (isset($value['rain'])) {
            $value['precipitation'] = array('value' => $value['rain']);
            unset($value['rain']);
        }
        // weather
        if (isset($value['weather']) && is_array($value['weather'])) {
            $weather = $value['weather'];
            unset($value['weather']);
            foreach ($weather as $index => $data) {
                if (is_array($data)) {
                    if (isset($data['id'])) {
                        $value['symbol']['number'] = $data['id'];
                    }
                    if (isset($data['description'])) {
                        $value['clouds']['value'] = $data['description'];
                    }
                    if (isset($data['icon'])) {
                        $value['symbol']['icon'] = $data['icon'];
                    }
                    break;
                }
            }
        }
        return $this->getHydrator()->hydrate($value, new Time());
    }
}
