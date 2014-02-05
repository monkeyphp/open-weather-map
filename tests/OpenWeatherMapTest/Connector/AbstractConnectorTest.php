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
use stdClass;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Http\Response;

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
     * Test that we can get and set the Lock
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getLock
     * @covers \OpenWeatherMap\Connector\AbstractConnector::setLock
     */
    public function testGetSetLock()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mockLock = $this->getMock('\OpenWeatherMap\Lock\LockInterface');

        $this->assertNull($mockConnector->getLock());
        $this->assertSame($mockConnector, $mockConnector->setLock($mockLock));
        $this->assertSame($mockLock, $mockConnector->getLock());
    }

    /**
     * Test that we can get the end point
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getEndpoint
     */
    public function testGetEndPoint()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $endPoint = $mockConnector->getEndPoint();
        $this->assertInternalType('string', $endPoint);
    }

    /**
     * Test that we can get the uri
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getUri
     */
    public function testGetUri()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $this->assertInternalType('string', $mockConnector->getUri());
    }

    /**
     * Test that we can retrieve the service uri
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getServiceUri
     */
    public function testGetServiceUri()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $this->assertInternalType('string', $mockConnector->getServiceUri());
    }

    /**
     * Test that we can get the array of languages
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getLanguages
     */
    public function testGetLanguages()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $this->assertInternalType('array', $mockConnector->getLanguages());
    }

    /**
     * Test that we can get the default mode
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getDefaultMode
     */
    public function testGetDefaultMode()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $this->assertInternalType('string', $mockConnector->getDefaultMode());
    }

    /**
     * Test that we can set the default mode
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::setDefaultMode
     */
    public function testSetDefaultMode()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = AbstractConnector::MODE_JSON;

        $this->assertSame($mockConnector, $mockConnector->setDefaultMode($mode));
        $this->assertEquals($mode, $mockConnector->getDefaultMode());
    }

    /**
     * Test that supplying an invalid value to setDefaultMode results in an exception
     * being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Connector\AbstractConnector::setDefaultMode
     */
    public function testSetDefaultModeThrowsException()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = 'foo';
        $mockConnector->setDefaultMode($mode);
    }

    /**
     * Test that we can call getModes and retrieve an array of valid modes
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getModes
     */
    public function testGetModes()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $this->assertInternalType('array', $mockConnector->getModes());
    }

    /**
     * Test that we can call getUnits and retrieve an array of valid units
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getUnits
     */
    public function testGetUnits()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $this->assertInternalType('array', $mockConnector->getUnits());
    }

    /**
     * Test that we can set the default language
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getDefaultLanguage
     * @covers \OpenWeatherMap\Connector\AbstractConnector::setDefaultLanguage
     */
    public function testSetDefaultLanguage()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $language = AbstractConnector::LANGUAGE_ITALIAN;

        $this->assertSame($mockConnector, $mockConnector->setDefaultLanguage($language));
        $this->assertEquals($language, $mockConnector->getDefaultLanguage());
    }

    /**
     * Test that attempting to set the default language to an invalid value
     * results in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Connector\AbstractConnector::setDefaultLanguage
     */
    public function testSetDefaultLanguageThrowsException()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $language = 'foo';
        $mockConnector->setDefaultLanguage($language);
    }

    /**
     * Test that we can retrieve the default language
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getDefaultLanguage
     */
    public function testGetDefaultLanguage()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $this->assertInternalType('string', $mockConnector->getDefaultLanguage());
    }

    /**
     * Test that we can retrieve the default units
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getDefaultUnits
     */
    public function testGetDefaultUnits()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $this->assertInternalType('string', $mockConnector->getDefaultUnits());
    }

    /**
     * Test that we can set the default units
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::setDefaultUnits
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
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Connector\AbstractConnector::setDefaultUnits
     */
    public function testSetDefaultUnitsThrowsException()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $units = 'foo';
        $mockConnector->setDefaultUnits($units);
    }

    /**
     * Test that we can get the default options
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getDefaultOptions
     */
    public function testGetDefaultOptions()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $defaultOptions = $mockConnector->getDefaultOptions();

        $this->assertInternalType('array', $defaultOptions);
        $this->assertArrayHasKey('mode', $defaultOptions);
        $this->assertArrayHasKey('language', $defaultOptions);
        $this->assertArrayHasKey('units', $defaultOptions);
    }

    /**
     * Test that we can retrieve an instance of Xml when we pass the xml mode
     * to the getReader method
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getReader
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
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getReader
     */
    public function testGetReaderJson()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = AbstractConnector::MODE_JSON;

        $reader = $mockConnector->getReader($mode);

        $this->assertInstanceOf('\Zend\Config\Reader\Json', $reader);
    }

    /**
     * Test that attempting to get a reader with an invalid mode will result in
     * an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getReader
     */
    public function testGetReaderThrowsException()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $mode = 'foo';
        $mockConnector->getReader($mode);
    }

    /**
     * Test that we can retrieve an instance of Http Client
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getHttpClient
     */
    public function testGetHttpClient()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $client = $mockConnector->getHttpClient();
        $this->assertInstanceOf('\Zend\Http\Client', $client);
    }

    /**
     * Test that we can set the instance of Http Client
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::setHttpClient
     */
    public function testSetHttpClient()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $client = new Client();

        $this->assertSame($mockConnector, $mockConnector->setHttpClient($client));
        $this->assertSame($client, $mockConnector->getHttpClient());
    }

    /**
     * Test that we can get an instance of Request
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getRequest
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
     * Test that attempting to call getRequest with an invalid uri will result
     * in an exception being thrown
     *
     * @expectedException Exception
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getRequest
     */
    public function testGetRequestThrowsExceptionInvalidUri()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $uri = new stdClass();
        $mockConnector->getRequest($uri);
    }

    /**
     * Test that we can correctly parse the supplied options in a params array
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::parseParams
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

    /**
     * Test that passing an empty array to parseParams will result in an
     * empty array being returned
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::parseParams
     */
    public function testParseParamsWithEmptyOptions()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $params = $mockConnector->parseParams(array());

        $this->assertInternalType('array', $params);
        $this->assertArrayNotHasKey(AbstractConnector::PARAM_MODE, $params);
        $this->assertArrayNotHasKey(AbstractConnector::PARAM_UNITS, $params);
        $this->assertArrayNotHasKey(AbstractConnector::PARAM_LANGUAGE, $params);
        $this->assertArrayNotHasKey(AbstractConnector::PARAM_APPID, $params);
    }

    /**
     * Test that a call to getResponse will return an instance of Response if
     * the statusCode of the response is okay
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getResponse
     */
    public function testGetResponse()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $request = new Request();
        $response = new Response();
        $response->setStatusCode(200);

        $mockHttpClient = $this->getMock('\Zend\Http\Client');
        $mockHttpClient->expects($this->once())
            ->method('dispatch')
            ->with($request)
            ->will($this->returnValue($response));

        $mockConnector->setHttpClient($mockHttpClient);

        $this->assertSame($response, $mockConnector->getResponse($request));
    }

    /**
     * Tests that a call to getResponse that results in a failed response
     * throws an exception
     *
     * @expectedException RuntimeException
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getResponse
     */
    public function testGetResponseThrowsRuntimeException()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $request = new Request();
        $response = new Response();
        $response->setStatusCode(500);

        $mockHttpClient = $this->getMock('\Zend\Http\Client');
        $mockHttpClient->expects($this->once())
            ->method('dispatch')
            ->with($request)
            ->will($this->returnValue($response));

        $mockConnector->setHttpClient($mockHttpClient);
        $mockConnector->getResponse($request);
    }

    /**
     * Test that we can get an InputFilter instance
     *
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testGetInputFilter()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');

        $this->assertInstanceOf('\Zend\InputFilter\InputFilter', $mockConnector->getInputFilter());
    }

    /**
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testInputFilterInvalidMode()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $inputFilter = $mockConnector->getInputFilter();
        $inputFilter->setData(array('mode' => 'foobar'));

        $isValid = $inputFilter->isValid();
        $messages = $inputFilter->getMessages();

        $this->assertFalse($isValid);
        $this->assertArrayHasKey('mode', $messages);
    }

    /**
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testInputFilterInvalidUnits()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $inputFilter = $mockConnector->getInputFilter();
        $inputFilter->setData(array('units' => 'foobar'));

        $isValid = $inputFilter->isValid();
        $messages = $inputFilter->getMessages();

        $this->assertFalse($isValid);
        $this->assertArrayHasKey('units', $messages);
    }

    /**
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testInputFilterInvalidLanguage()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $inputFilter = $mockConnector->getInputFilter();
        $inputFilter->setData(array('language' => 'foobar'));

        $isValid = $inputFilter->isValid();
        $messages = $inputFilter->getMessages();

        $this->assertFalse($isValid);
        $this->assertArrayHasKey('language', $messages);
    }

    /**
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testInputFilterInvalidQuery()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $inputFilter = $mockConnector->getInputFilter();
        $inputFilter->setData(array('query' => str_repeat('a', 101)));

        $isValid = $inputFilter->isValid();
        $messages = $inputFilter->getMessages();

        $this->assertFalse($isValid);
        $this->assertArrayHasKey('query', $messages);
    }

    /**
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testInputFilterInvalidLatitude()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $inputFilter = $mockConnector->getInputFilter();

        $this->markTestIncomplete();
    }

    


    /**
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testInputFilterInvalidLongitude()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $inputFilter = $mockConnector->getInputFilter();

        $this->markTestIncomplete();
    }

    /**
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testInputFilterInvalidId()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $inputFilter = $mockConnector->getInputFilter();

        $this->markTestIncomplete();
    }

    /**
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testInputFilterInvalidApiKey()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $inputFilter = $mockConnector->getInputFilter();

        $this->markTestIncomplete();
    }

    /**
     * @covers \OpenWeatherMap\Connector\AbstractConnector::getInputFilter
     */
    public function testInputFilterInvalidAtLeastOne()
    {
        $mockConnector = $this->getMockForAbstractClass('\OpenWeatherMap\Connector\AbstractConnector');
        $inputFilter = $mockConnector->getInputFilter();

        $this->markTestIncomplete();
    }
}
