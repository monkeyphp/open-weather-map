<?php
/**
 * CloudsStrategyTest.php
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

use OpenWeatherMap\Entity\Clouds;
use OpenWeatherMap\Hydrator\Strategy\CloudsStrategy;
use PHPUnit_Framework_TestCase;
use stdClass;

/**
 * Description of CloudsStrategyTest
 *
 * @author David White <david@monkeyphp.com>
 */
class CloudsStrategyTest extends PHPUnit_Framework_TestCase
{
    // <clouds value="broken clouds" all="56" unit="%"/>
    /**
     * Test that we can hydrate an instance of Clouds
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CloudsStrategy::hydrate
     */
    public function testHydrate()
    {
        $value = 'broken clouds';
        $all = 56;
        $unit = '%';
        $strategy = new CloudsStrategy();

        /* @var $clouds Clouds */
        $clouds = $strategy->hydrate(compact('value', 'all', 'unit'));

        $this->assertInstanceOf('\OpenWeatherMap\Entity\Clouds', $clouds);
        $this->assertEquals($value, $clouds->getValue());
        $this->assertEquals($all, $clouds->getAll());
        $this->assertEquals($unit, $clouds->getUnit());

    }

    /**
     * Test that attempting to hydrate using a non array parameter results in
     * null being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CloudsStrategy::hydrate
     */
    public function testHydrateReturnsNull()
    {
        $strategy = new CloudsStrategy();

        $this->assertNull($strategy->hydrate(new stdClass()));
    }

    /**
     * Test that we can extract the values from an instance of Clouds
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CloudsStrategy::extract
     */
    public function testExtract()
    {
        $value = 'broken clouds';
        $all = 56;
        $unit = '%';
        $clouds = new Clouds();
        $clouds->setAll($all)->setUnit($unit)->setValue($value);
        $strategy = new CloudsStrategy();

        $values = $strategy->extract($clouds);

        $this->assertArrayHasKey('value', $values);
        $this->assertArrayHasKey('all', $values);
        $this->assertArrayHasKey('unit', $values);
    }

    /**
     * Test that attempting to extract a non Clouds instance results in null
     * being returned
     *
     * @covers \OpenWeatherMap\Hydrator\Strategy\CloudsStrategy::extract
     */
    public function testExtractReturnsNull()
    {
        $strategy = new CloudsStrategy();

        $this->assertNull($strategy->extract(new stdClass()));
    }
}
