<?php
/**
 * MetaStrategyTest.php
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

use OpenWeatherMap\Entity\Meta;
use OpenWeatherMap\Hydrator\Strategy\MetaStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * MetaStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class MetaStrategyTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can hydrate an instance of Meta using an array
     * of values
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\MetaStrategy::hydrate
     */
    public function testHydrate()
    {
        $lastupdate = null;
        $calctime = 0.0032;
        $nextupdate = null;
        $strategy = new MetaStrategy();

        $meta = $strategy->hydrate(compact('lastupdate', 'calctime', 'nextupdate'));

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Meta', $meta);
        $this->assertEquals($lastupdate, $meta->getLastUpdate());
        $this->assertEquals($calctime, $meta->getCalcTime());
        $this->assertEquals($nextupdate, $meta->getNextUpdate());
    }

    /**
     * Test that attempting to hydrate with a non array parameter results in
     * null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\MetaStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new MetaStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract the values from a Meta instance
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\MetaStrategy::extract
     */
    public function testExtract()
    {
        $calctime = 0.0032;
        $meta = new Meta();
        $meta->setCalcTime($calctime);
        $strategy = new MetaStrategy();

        $values = $strategy->extract($meta);

        $this->assertArrayHasKey('calcTime', $values);
        $this->assertEquals($values['calcTime'], $calctime);
    }

    /**
     * Test that attempting to extract the values from a non Meta instance
     * returns null
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\MetaStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new MetaStrategy();

        $this->assertNull($strategy->extract(new stdClass()));
    }
}
