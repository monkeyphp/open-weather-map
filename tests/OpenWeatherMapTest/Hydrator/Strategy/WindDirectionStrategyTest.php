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

use OpenWeatherMap\Entity\WindDirection;
use OpenWeatherMap\Hydrator\Strategy\WindDirectionStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

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
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\WindDirectionStrategy::hydrate
     */
    public function testHydrate()
    {
        $deg = 183.501;
        $windDirectionStrategy = new WindDirectionStrategy();

        $windDirection = $windDirectionStrategy->hydrate(compact('deg'));

        $this->assertInstanceOf('\OpenWeatherMap\Entity\WindDirection', $windDirection);
        $this->assertEquals($deg, $windDirection->getDeg());
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\WindDirectionStrategy::hydrate
     */
    public function testhydrateReturnsNull()
    {
        $windDirectionStrategy = new WindDirectionStrategy();

        $this->assertNull($windDirectionStrategy->hydrate(new stdClass()));
    }

    /**
     *
     * <windDirection
     * deg="256"
     * code="WSW"
     * name="West-southwest"/>
     * @covers \OpenWeatherMap\Hydrator\Strategy\WindDirectionStrategy::extract
     */
    public function testExtract()
    {
        $deg = 256;
        $code = "WSW";
        $name = "West-southwest";
        $windDirection = new WindDirection();
        $windDirection->setDeg($deg)->setCode($code)->setName($name);
        $windDirectionStrategy = new WindDirectionStrategy();

        $values = $windDirectionStrategy->extract($windDirection);

        $this->assertArrayHasKey('deg', $values);
        $this->assertArrayHasKey('code', $values);
        $this->assertArrayHasKey('name', $values);
        $this->assertEquals($values['deg'], $deg);
        $this->assertEquals($values['code'], $code);
        $this->assertEquals($values['name'], $name);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\WindDirectionStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $windDirectionStrategy = new WindDirectionStrategy();

        $this->assertNull($windDirectionStrategy->extract(new stdClass()));
    }
}
