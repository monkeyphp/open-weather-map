<?php
/**
 * WeatherConnector.php
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector
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
namespace OpenWeatherMap\Connector;

use Exception;
use OpenWeatherMap\Entity\Current;
use OpenWeatherMap\Hydrator\Strategy\CityStrategy;
use OpenWeatherMap\Hydrator\Strategy\CloudsStrategy;
use OpenWeatherMap\Hydrator\Strategy\HumidityStrategy;
use OpenWeatherMap\Hydrator\Strategy\LastUpdateStrategy;
use OpenWeatherMap\Hydrator\Strategy\PrecipitationStrategy;
use OpenWeatherMap\Hydrator\Strategy\PressureStrategy;
use OpenWeatherMap\Hydrator\Strategy\TemperatureStrategy;
use OpenWeatherMap\Hydrator\Strategy\WeatherStrategy;
use OpenWeatherMap\Hydrator\Strategy\WindStrategy;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * WeatherConnector
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WeatherConnector extends AbstractConnector implements WeatherConnectorInterface
{
    
    protected $endPoint = 'weather';
    
    /**
     * Return an instance of ClassMethods
     * 
     * @return ClassMethods
     */
    public function getHydrator()
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
    
    /**
     * Return the instance of InputFilter
     * 
     * @return InputFilter
     */
    public function getInputFilter()
    {
        if (! isset($this->inputFilter)) {
            $inputFilter = parent::getInputFilter();
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
    
    /**
     * Allowed options are
     * 
     * - id
     * - query
     * - latitude
     * - longitude
     * - mode
     * - units
     * - language
     * 
     * @param array $options
     * 
     * @return Current
     */
    public function getWeather($options = array())
    {
        $options = array_merge($this->getDefaultOptions(), $options);
        
        $inputFilter = $this->getInputFilter()->setData($options);
        
        if (! $inputFilter->isValid($options)) {
            return $inputFilter->getMessages();
        }
        
        $options = $inputFilter->getValues();
        
        $params = array(
            self::PARAM_MODE     => $options['mode'],
            self::PARAM_UNITS    => $options['units'],
            self::PARAM_LANGUAGE => $options['language']
        );
        
        if (isset($options['query'])) {
            $params[self::PARAM_QUERY] = $options['query'];
        } elseif (isset($options['latitude']) && isset($options['longitude'])) {
            $params[self::PARAM_LATITUDE]  = $options['latitude'];
            $params[self::PARAM_LONGITUDE] = $options['longitude'];
        } else if (isset($options['id'])) {
            $params[self::PARAM_ID] = $options['id'];
        } else {
            throw new Exception('A required value was not supplied');
        }
        
        $request = $this->getRequest($this->getUri(), $params);
        
        $response = $this->getHttpClient()->dispatch($request);
        
        $body = $response->getBody();
        
        $data = $this->getReader($options['mode'])->fromString($body);
        
        $current = new Current();
        
        $this->getHydrator()->hydrate($data, $current);
        
        return $current;
    }
}
