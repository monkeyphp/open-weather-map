<?php
/**
 * ForecastConnector.php
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

use OpenWeatherMap\Connector\AbstractConnector;
use OpenWeatherMap\Connector\ForecastConnectorInterface;
use OpenWeatherMap\Entity\WeatherData;
use OpenWeatherMap\Hydrator\Strategy\CreditStrategy;
use OpenWeatherMap\Hydrator\Strategy\ForecastStrategy;
use OpenWeatherMap\Hydrator\Strategy\LocationStrategy;
use OpenWeatherMap\Hydrator\Strategy\MetaStrategy;
use OpenWeatherMap\Hydrator\Strategy\SunStrategy;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\HydratorInterface;
/**
 * ForecastConnector
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class ForecastConnector extends AbstractConnector implements ForecastConnectorInterface
{
    /**
     * Url api endpoint
     * 
     * @var string
     */
    protected $endPoint = 'forecast';
    
    /**
     *
     * @var string
     */
    protected $resultClassname = 'OpenWeatherMap\Entity\WeatherData';
    
    /**
     * Return an instance of HydratorInterface
     * 
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        if (! isset($this->hydrator)) {
            $hydrator = new ClassMethods();
            $hydrator->addStrategy('location', new LocationStrategy());
            $hydrator->addStrategy('credit', new CreditStrategy());
            $hydrator->addStrategy('meta', new MetaStrategy());
            $hydrator->addStrategy('sun', new SunStrategy());
            $hydrator->addStrategy('forecast', new ForecastStrategy());
            $this->hydrator = $hydrator;
        }
        return $this->hydrator;
    }
    
    /**
     * Return an instance of WeatherData
     * 
     * @param array $options
     * 
     * @return WeatherData
     */
    public function getForecast($options = array())
    {
        return parent::query($options);
    }
}
