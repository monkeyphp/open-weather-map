<?php
/**
 * ForecastStrategy.php
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

use OpenWeatherMap\Entity\Forecast;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * ForecastStrategy
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class ForecastStrategy implements StrategyInterface
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
            $hydrator->addStrategy('times', new TimesStrategy());
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
    }
    
    /**
     * Extract the values from the supplied Forecast instance into an array
     * 
     * @param Forecast $value The Forecast instance to extract values from
     * 
     * @return null|array
     */
    public function extract($value)
    {
        if (! $value instanceof Forecast) {
            return null;
        }
        return $this->getHydrator()->extract($value);
    }

    /**
     * Hydrate the supplied array of parameters into an instance of Forecast
     * 
     * @param array $value
     * 
     * @return Forecast|null
     */
    public function hydrate($value)
    {
        if (! is_array($value)) {
            return null;
        }
        if (isset($value['time']) && is_array($value['time'])) {
            $value['times'] = $value['time'];
            unset($value['time']);
        }
        return $this->getHydrator()->hydrate($value, new Forecast());
    }
}
