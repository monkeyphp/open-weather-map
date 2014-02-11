<?php
/**
 * SunStrategyTest.php
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

use OpenWeatherMap\Entity\Sun;
use OpenWeatherMap\Hydrator\Strategy\SunStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * SunStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class SunStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an instance of Sun
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\SunStrategy::hydrate
     */
    public function testHydrate()
    {
        $rise = '2014-01-01T06:00:00';
        $set = '2014-01-01T20:00:00';
        $strategy = new SunStrategy();

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Sun', $strategy->hydrate(compact('rise', 'set')));
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\SunStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new SunStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract the values from an instance of Sun
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\SunStrategy::extract
     */
    public function testExtract()
    {
        $rise = '2014-01-01T06:00:00';
        $set = '2014-01-01T20:00:00';
        $strategy = new SunStrategy();
        $sun = new Sun();
        $sun->setRise($rise)->setSet($set);

        $values = $strategy->extract($sun);

        $this->assertArrayHasKey('rise', $values);
        $this->assertArrayHasKey('set', $values);
    }

    /**
     * @covers \OpenWeatherMap\Hydrator\Strategy\SunStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new SunStrategy();

        $this->assertNull($strategy->extract(new stdClass()));
    }
}
