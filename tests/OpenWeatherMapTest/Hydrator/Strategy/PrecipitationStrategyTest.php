<?php
/**
 * PrecipitationStrategyTest.php
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

use OpenWeatherMap\Entity\Precipitation;
use OpenWeatherMap\Hydrator\Strategy\PrecipitationStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * PrecipitationStrategyTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Hydrator\Strategy
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class PrecipitationStrategyTest extends PHPUnit_Framework_TestCase
{
    // <precipitation value="1" type="snow"/>

    /**
     * Test that we can hydrate an instance of Precipitation
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\PrecipitationStrategy::hydrate
     */
    public function testHydrate()
    {
        $value = 1;
        $type = 'snow';
        $strategy = new PrecipitationStrategy();

        $precipitation = $strategy->hydrate(compact('value', 'type'));

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Precipitation', $precipitation);
        $this->assertEquals($value, $precipitation->getValue());
        $this->assertEquals($type, $precipitation->getType());
    }

    /**
     * Test that attempting to call hydrate with a non array parameter
     * returns null
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\PrecipitationStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new PrecipitationStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract the values from an instance of Precipitation
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\PrecipitationStrategy::extract
     */
    public function testExtract()
    {
        $value = 1;
        $type = 'snow';
        $precipitation = new Precipitation();
        $precipitation->setValue($value)->setType($type);
        $strategy = new PrecipitationStrategy();

        $values = $strategy->extract($precipitation);

        $this->assertArrayHasKey('value', $values);
        $this->assertArrayHasKey('type', $values);
    }

    /**
     * Test that attempting to extract the values from a non Precipitation
     * instance results in null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\PrecipitationStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new PrecipitationStrategy();

        $this->assertNull($strategy->extract(new stdClass()));
    }
}
