<?php
/**
 * AbstractConnectorTest.php
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

use PHPUnit_Framework_TestCase;

/**
 * AbstractConnectorTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class AbstractConnectorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can get the Lock
     */
    public function testGetLock()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertNull($mockConnector->getLock());
    }
    
    /**
     * Test that we can set the Lock
     */
    public function testSetLock()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface');
        
        $this->assertSame($mockConnector, $mockConnector->setLock($mockLock));
        $this->assertSame($mockLock, $mockConnector->getLock());
    }
    
    /**
     * Test that we can get the uri
     */
    public function testGetUri()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('string', $mockConnector->getUri());
    }
    
    /**
     * Test that we can get the array of languages
     */
    public function testGetLanguages()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('array', $mockConnector->getLanguages());
    }
    
    /**
     * Test that we can get the default mode
     */
    public function testGetDefaultMode()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('string', $mockConnector->getDefaultMode());
    }
    
    
}
