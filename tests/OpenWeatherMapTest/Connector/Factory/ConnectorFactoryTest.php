<?php
/**
 * ConnectorFactoryTest.php
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector\Factory
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
namespace OpenWeatherMapTest\Connector\Factory;

use OpenWeatherMap\Connector\Factory\ConnectorFactory;
use PHPUnit_Framework_TestCase;

/**
 * ConnectorFactoryTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector\Factory
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class ConnectorFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can construct an instance of ConnectorFactory
     */
    public function test__construct()
    {
        $connectorFactory = new ConnectorFactory();
        $this->assertInstanceOf('\OpenWeatherMap\Connector\Factory\ConnectorFactoryInterface', $connectorFactory);
    }
    
    /**
     * Test that calling getLock will return an instance of LockInterface
     */
    public function testGetLock()
    {
        $connectorFactory = new ConnectorFactory();
        $this->assertInstanceOf('\OpenWeatherMap\Lock\LockInterface', $connectorFactory->getLock());
    }
    
    /**
     * Test that we can set the Lock instance
     */
    public function testSetLock()
    {
        $connectorFactory = new ConnectorFactory();
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface');
        
        $this->assertSame($connectorFactory, $connectorFactory->setLock($mockLock));
        $this->assertSame($connectorFactory->getLock(), $mockLock);
    }
    
    /**
     * Test that we can get an instance of WeatherConnector and that the Lock instance
     * is injected into it
     */
    public function testGetWeatherConnector()
    {
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface');
        $connectorFactory = new ConnectorFactory();
        $connectorFactory->setLock($mockLock);
        
        $weatherConnector = $connectorFactory->getWeatherConnector();
        
        $this->assertInstanceof('\OpenWeatherMap\Connector\WeatherConnectorInterface', $weatherConnector);
        $this->assertSame($weatherConnector->getLock(), $mockLock);
    }
}
