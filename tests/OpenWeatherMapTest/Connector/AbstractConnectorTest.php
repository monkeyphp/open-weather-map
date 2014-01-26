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

use OpenWeatherMap\Connector\AbstractConnector;
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
     * Test that we can get the end point
     */
    public function testGetEndPoint()
    {
        $this->markTestIncomplete();
    }
    
    /**
     * Test that we can get the uri
     */
    public function testGetUri()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('string', $mockConnector->getUri());
    }
    
    
    public function testGetServiceUri()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('string', $mockConnector->getServiceUri());
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
    
    /**
     * Test that we can set the default mode
     */
    public function testSetDefaultMode()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = 'json';
        
        $this->assertSame($mockConnector, $mockConnector->setDefaultMode($mode));
        $this->assertEquals($mode, $mockConnector->getDefaultMode());
    }
    
    /**
     * Test that supplying an invalid value to setDefaultMode results in an exception
     * being thrown
     */
    public function testSetDefaultModeThrowsException()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = 'foo';
        
        $this->setExpectedException('InvalidArgumentException');
        
        $mockConnector->setDefaultMode($mode);
    }
    
    /**
     * Test that we can call getModes and retrieve an array of valid modes
     */
    public function testGetModes()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('array', $mockConnector->getModes());
    }
    
    /**
     * Test that we can call getUnits and retrieve an array of valid units
     */
    public function testGetUnits()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('array', $mockConnector->getUnits());
    }
    
    /**
     * Test that we can set the default language
     */
    public function testSetDefaultLanguage()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $language = 'it';
        
        $this->assertSame($mockConnector, $mockConnector->setDefaultLanguage($language));
        $this->assertEquals($language, $mockConnector->getDefaultLanguage());
    }
    
    /**
     * Test that attempting to set the default language to an invalid value
     * results in an exception being thrown
     */
    public function testSetDefaultLanguageThrowsException()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $language = 'foo';
        
        $this->setExpectedException('InvalidArgumentException');
        
        $mockConnector->setDefaultLanguage($language);
    }
    
    /**
     * Test that we can retrieve the default language
     */
    public function testGetDefaultLanguage()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('string', $mockConnector->getDefaultLanguage());
    }
    
    /**
     * Test that we can retrieve the default units
     */
    public function testGetDefaultUnits()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('string', $mockConnector->getDefaultUnits());
    }
    
    /**
     * Test that we can set the default units
     */
    public function testSetDefaultUnits()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $units = 'imperial';
        
        $this->assertSame($mockConnector, $mockConnector->setDefaultUnits($units));
        $this->assertSame($units, $mockConnector->getDefaultUnits());
    }
    
    /**
     * Test that attempting to set the default units to an invalid value results
     * in an exception being thrown
     */
    public function testSetDefaultUnitsThrowsException()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $units = 'foo';
        
        $this->setExpectedException('InvalidArgumentException');
        
        $mockConnector->setDefaultUnits($units);
    }
    
    /**
     * Test that we can get the default options
     */
    public function testGetDefaultOptions()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInternalType('array', $mockConnector->getDefaultOptions());
    }
    
    /**
     * Test that we can retrieve an instance of Xml when we pass the xml mode 
     * to the getReader method
     */
    public function testGetReaderXml()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = AbstractConnector::MODE_XML;
        
        $reader = $mockConnector->getReader($mode);
        
        $this->assertInstanceOf('\Zend\Config\Reader\Xml', $reader);
    }
    
    /**
     * Test that we can retrieve an instance of a JSON reader when we pass
     * the json mode to the getReader method
     */
    public function testGetReaderJson()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = AbstractConnector::MODE_JSON;
        
        $reader = $mockConnector->getReader($mode);
        
        $this->assertInstanceOf('\Zend\Config\Reader\Json', $reader);
    }
    
    public function testGetReaderThrowsException()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = 'foo';
        
        $this->setExpectedException('InvalidArgumentException');
        $mockConnector->getReader($mode);
    }
    /**
     * Test that we can retrieve an instance of Http Client
     */
    public function testGetHttpClient()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInstanceOf('\Zend\Http\Client', $mockConnector->getHttpClient());
    }
    
    public function testSetHttpClient()
    {
        $this->markTestIncomplete();
    }
    
    /**
     * Test that we can get an instance of Request
     */
    public function testGetRequest()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $uri = 'http://example.com';
        $params = array();
        
        $request = $mockConnector->getRequest($uri, $params);
        
        $this->assertInstanceOf('\Zend\http\Request', $request);
    }
    
    /**
     * Test that we can correctly parse the supplied options in a params array
     */
    public function testParseParams()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = AbstractConnector::MODE_XML;
        $units = AbstractConnector::UNITS_METRIC;
        $language = AbstractConnector::LANGUAGE_FINNISH;
        $apiKey = '123123123';
        $options = compact("mode", "units", "language", "apiKey");
        
        $params = $mockConnector->parseParams($options);
        
        $this->assertInternalType('array', $params);
        $this->assertArrayHasKey(AbstractConnector::PARAM_MODE, $params);
        $this->assertArrayHasKey(AbstractConnector::PARAM_UNITS, $params);
        $this->assertArrayHasKey(AbstractConnector::PARAM_LANGUAGE, $params);
        $this->assertArrayHasKey(AbstractConnector::PARAM_APPID, $params);
    }
    
    public function testParseParamsWithEmptyOptions()
    {
        $this->markTestIncomplete();
    }
    
    
    public function testGetResultClassname() 
    {
        $this->markTestIncomplete();
    }
    
    // protected
    public function testGetResponse()
    {
        $this->markTestIncomplete();
    }
    
    
    
    /**
     * Test that we can get an InputFilter instance
     */
    public function testGetInputFilter()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        
        $this->assertInstanceOf('\Zend\InputFilter\InputFilter', $mockConnector->getInputFilter());
    }
}
