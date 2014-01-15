<?php
/**
 * OpenWeatherMapTest.php
 * 
 * @category OpenWeatherMapTest
 * @package  OpenWeatherMapTest
 * @author   David White [monkeyphp] <david@monkeyphp.com>
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
namespace OpenWeatherMapTest;

use OpenWeatherMap\OpenWeatherMap;
use PHPUnit_Framework_TestCase;

/**
 * OpenWeatherMapTest
 * 
 * @category OpenWeatherMapTest
 * @package  OpenWeatherMapTest
 * @author   David White [monkeyphp] <david@monkeyphp.com>
 */
class OpenWeatherMapTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can create an instance of OpenWeatherMap
     */
    public function test__construct()
    {
        $openWeatherMap = new OpenWeatherMap();
        $this->assertInstanceOf('\OpenWeatherMap\OpenWeatherMapInterface', $openWeatherMap);
    }
    
    /**
     * Test that we can pass an options array when constructing an instance
     * of OpenWeatherMap
     */
    public function test__constructWithOptions()
    {
        $options = array();
        $openWeatherMap = new OpenWeatherMap($options);
        
        $this->assertEquals($options, $openWeatherMap->getOptions());
    }
    
    /**
     * Test that we can set the options value
     */
    public function testSetOptions()
    {
        $options = array('foo' => 'bar');
        $openWeatherMap = new OpenWeatherMap();
        
        $this->assertSame($openWeatherMap, $openWeatherMap->setOptions($options));
    }
}
