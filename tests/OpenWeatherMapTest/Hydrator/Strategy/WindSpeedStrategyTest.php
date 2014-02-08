<?php
/**
 * WindSpeedStrategyTest.php
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

use OpenWeatherMap\Entity\WindSpeed;
use OpenWeatherMap\Hydrator\Strategy\WindSpeedStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * WindSpeedStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class WindSpeedStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an instance of WindSpeed
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\WindSpeedStrategy::hydrate
     */
    public function testHydrate()
    {
        $mps = 10;
        $windSpeedStrategy = new WindSpeedStrategy();

        $windSpeed = $windSpeedStrategy->hydrate(compact('mps'));

        $this->assertInstanceOf('\OpenWeatherMap\Entity\WindSpeed', $windSpeed);
        $this->assertEquals($mps, $windSpeed->getMps());
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\WindSpeedStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $windSpeedStrategy = new WindSpeedStrategy();

        $this->assertNull($windSpeedStrategy->hydrate(new stdClass()));
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\WindSpeedStrategy::extract
     */
    public function testExtract()
    {
        $mps = 12;
        $windSpeed = new WindSpeed();
        $windSpeed->setMps($mps);
        $windSpeedStrategy = new WindSpeedStrategy();

        $values = $windSpeedStrategy->extract($windSpeed);

        $this->assertArrayHasKey('mps', $values);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\WindSpeedStrategy::extract
     */
    public function testExtractReturnNull()
    {
        $windSpeedStrategy = new WindSpeedStrategy();

        $this->assertNull($windSpeedStrategy->extract(new stdClass()));
    }
}
