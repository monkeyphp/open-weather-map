<?php
/**
 * CreditStrategyTest.php
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

use OpenWeatherMap\Entity\Credit;
use OpenWeatherMap\Hydrator\Strategy\CreditStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * CreditStrategyTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class CreditStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can extract the values
     */
    public function testExtract()
    {
        $credit = new Credit();
        $strategy = new CreditStrategy();
        
        $this->assertInternalType('array', $strategy->extract($credit));
    }
    
    /**
     * Test that attampting to extract the values from a non Credit
     * instance will return null
     */
    public function testExtractWithNonCreditInstance()
    {
        $value = new stdClass();
        $strategy = new CreditStrategy();
        
        $this->assertNull($strategy->extract($value));
    }
    
    /**
     * Test that we can hydrate a Credit instance
     */
    public function testHydrate()
    {
        $values = array();
        $strategy = new CreditStrategy();
        
        $this->assertInstanceOf('\OpenWeatherMap\Entity\Credit', $strategy->hydrate($values));
    }
}
