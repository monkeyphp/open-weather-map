<?php
/**
 * SymbolStrategTesty.php
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
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
namespace OpenWeatherMapTest\Hydrator\Strategy;

use OpenWeatherMap\Entity\Symbol;
use OpenWeatherMap\Hydrator\Strategy\SymbolStrategy;
use PHPUnit_Framework_TestCase;

/**
 * SymbolStrategTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com> */
class SymbolStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate
     */
    public function testHydrate()
    {
        $value = array();
        $strategy = new SymbolStrategy();
        
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Symbol', $strategy->hydrate($value));
    }
    
    public function testExtract()
    {
        $number = 802;
        $name   = 'scattered clouds';
        $var    = '03n';
        $symbol = new Symbol();
        $symbol->setNumber($number)
            ->setName($name)
            ->setVar($var);
        $strategy = new SymbolStrategy();
        
        $value = $strategy->extract($symbol);
        
        $this->assertInternalType('array', $value);
        $this->assertArrayHasKey('number', $value);
        $this->assertArrayHasKey('name', $value);
        $this->assertArrayHasKey('var', $value);
    }
    
    public function testExtractReturnsNull()
    {
        $value = new \stdClass();
        $strategy = new SymbolStrategy();
        
        $this->assertNull($strategy->extract($value));
    }
}
