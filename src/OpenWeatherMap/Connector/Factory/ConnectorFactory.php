<?php
/**
 * ConnectorFactory.php
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector\Factory
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
namespace OpenWeatherMap\Connector\Factory;

use OpenWeatherMap\Connector\DailyConnector;
use OpenWeatherMap\Connector\DailyConnectorInterface;
use OpenWeatherMap\Connector\ForecastConnector;
use OpenWeatherMap\Connector\ForecastConnectorInterface;
use OpenWeatherMap\Connector\WeatherConnector;
use OpenWeatherMap\Connector\WeatherConnectorInterface;
use OpenWeatherMap\Lock\Lock;
use OpenWeatherMap\Lock\LockInterface;

/**
 * ConnectorFactory
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector\Factory
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class ConnectorFactory implements ConnectorFactoryInterface
{
    /**
     * Instance of LockInterface, an array used to construct a Lock instsance 
     * with or null
     * 
     * @var Lock|array|null
     */
    protected $lock;
    
    /**
     * Instance of WeatherConnectorInterface
     * 
     * @var WeatherConnectorInterface
     */
    protected $weatherConnector;
    
    /**
     * Instance of DailyConnectorInterface
     * 
     * @var DailyConnectorInterface
     */
    protected $dailyConnector;
    
    /**
     * Instance of ForecaseConnectorInterface
     * 
     * @var ForecastConnectorInterface
     */
    protected $forecastConnector;
    
    public function __construct($options = array())
    {
        $this->setOptions($options);
    }
    
    public function setOptions($options = array())
    {
        if (is_array($options) || ($options instanceof \Traversable)) {
            
            foreach ($options as $key => $value) {
                $key = strtolower($key);
                switch($key) {
                    case 'lock':
                        $this->setLock($value);
                        break;
                }
            }
        }
    }
    
    /**
     * Return an instance of Lock
     * 
     * If the LockInterface has not been provided, this method will create
     * an instance of Lock and set the $lock property before returning the 
     * Lock
     * 
     * @return LockInterface
     */
    public function getLock()
    {
        if (! isset($this->lock)) {
            
            $lock = new Lock(array(
                'minLifetime' => 600, 
                'maxLifetime' => 1000
            ));
            
            $this->lock = $lock;
        }
        return $this->lock;
    }
    
    /**
     * Set the instance of LockInterface
     * 
     * @param LockInterface|array $lock
     * 
     * @return ConnectorFactory
     */
    public function setLock($lock = array())
    {
        if (is_array($lock)) {
            $lock = new Lock($lock);
        }
        
        if ($lock instanceof LockInterface) {
            $this->lock = $lock;
        }
        
        return $this;
    }
    
    /**
     * Return an instance of WeatherConnectorInterface
     * 
     * @return WeatherConnectorInterface
     */
    public function getWeatherConnector()
    {
        if (! isset($this->weatherConnector)) {
            $weatherConnector = new WeatherConnector();
            $weatherConnector->setLock($this->getLock());
            $this->weatherConnector = $weatherConnector;
        }
        return $this->weatherConnector;
    }
    
    /**
     * Return an instance of DailyConnectorInterface
     * 
     * @return DailyConnectorInterface
     */
    public function getDailyConnector()
    {
        if (! isset($this->dailyConnector)) {
            $dailyConnector = new DailyConnector();
            $dailyConnector->setLock($this->getLock());
            $this->dailyConnector = $dailyConnector;
        }
        return $this->dailyConnector;
    }
    
    /**
     * Return an instance of ForecastConnectorInterface
     * 
     * @return ForecastConnectorInterface
     */
    public function getForecastConnector()
    {
        if (! isset($this->forecastConnectot)) {
            $forecastConnector = new ForecastConnector();
            $forecastConnector->setLock($this->getLock());
            $this->forecastConnector = $forecastConnector;
        }
        return $this->forecastConnector;
    }
}
