<?php
/**
 * WeatherConnectorTest.php
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector
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
namespace OpenWeatherMapTest\Connector;

use OpenWeatherMap\Connector\WeatherConnector;
use PHPUnit_Framework_TestCase;

/**
* WeatherConnectorTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WeatherConnectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can construct an instance of WeatherConnector
     */
    public function test__construct()
    {
        $weatherConnector = new WeatherConnector();
        
        $this->assertInstanceOf('\OpenWeatherMap\Connector\WeatherConnectorInterface', $weatherConnector);
        $this->assertInstanceOf('\OpenWeatherMap\Connector\AbstractConnector', $weatherConnector);
    }
    
    /**
     * Test that we can get an instance of ClassMethods hydrator
     */
    public function testGetHydrator()
    {
        $weatherConnector = new WeatherConnector();
        
        $this->assertInstanceOf('\Zend\Stdlib\Hydrator\ClassMethods', $weatherConnector->getHydrator());
    }
}
