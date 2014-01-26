<?php
/**
 * WindDirectionStrategyTest.php
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

use OpenWeatherMap\Hydrator\Strategy\WindDirectionStrategy;
use PHPUnit_Framework_TestCase;

/**
 * WindDirectionStrategyTest
 * 
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WindDirectionStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate a WindDirection instance
     */
    public function testHydrate()
    {
        $deg = '183.501';
        $value = array(
            'deg' => $deg
        );
        $windDirectionStrategy = new WindDirectionStrategy();
        
        $windDirection = $windDirectionStrategy->hydrate($value);
        
        $this->assertInstanceOf('\OpenWeatherMap\Entity\WindDirection', $windDirection);
        $this->assertEquals($deg, $windDirection->getDeg());
    }
}
