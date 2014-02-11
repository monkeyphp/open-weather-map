<?php
/**
 * TemperatureTest.php
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
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
namespace OpenWeatherMapTest\Entity;

use OpenWeatherMap\Entity\Temperature;
use PHPUnit_Framework_TestCase;

/**
 * TemperatureTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\Entity
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class TemperatureTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that we can get and set the day value
     *
     * @covers \OpenWeatherMap\Entity\Temperature::getDay
     * @covers \OpenWeatherMap\Entity\Temperature::setDay
     */
    public function testGetSetDay()
    {
        $day = "6.07";
        $temperature = new Temperature();

        $this->assertNull($temperature->getDay());
        $this->assertSame($temperature, $temperature->setDay($day));
        $this->assertEquals($day, $temperature->getDay());
    }

    /**
     * Test that attempting to set the day value by supplying a non scalar
     * value results in a exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setDay
     */
    public function testSetDayWithNonScalarThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setDay(new \stdClass());
    }

    /**
     * Test that we can get and set the min property
     *
     * @covers \OpenWeatherMap\Entity\Temperature::getMin
     * @covers \OpenWeatherMap\Entity\Temperature::setMin
     */
    public function testGetSetMin()
    {
        $min = "1.5";
        $temperature = new Temperature();

        $this->assertNull($temperature->getMin());
        $this->assertSame($temperature, $temperature->setMin($min));
        $this->assertEquals($min, $temperature->getMin());
    }

    /**
     * Test that attempting the set the min property with a non scalar
     * value results in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setMin
     */
    public function testSetMinWithNonScalarThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setMin(new \stdClass());
    }
    /**
     * Test that we can get and set the max property
     *
     * @covers \OpenWeatherMap\Entity\Temperature::getMax
     * @covers \OpenWeatherMap\Entity\Temperature::setMax
     */
    public function testGetSetMax()
    {
        $max = "6.07";
        $temperature = new Temperature();

        $this->assertNull($temperature->getMax());
        $this->assertSame($temperature, $temperature->setMax($max));
        $this->assertEquals($max, $temperature->getMax());
    }

    /**
     * Test that attampting to set the max property with a non scalar value
     * results in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setMax
     */
    public function testSetMaxWithNonScalarThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setMax(new \stdClass());
    }

    /**
     * Test that we can get and set the night value
     *
     * @covers \OpenWeatherMap\Entity\Temperature::getNight
     * @covers \OpenWeatherMap\Entity\Temperature::setNight
     */
    public function testGetSetNight()
    {
        $night = "1.57";
        $temperature = new Temperature();

        $this->assertNull($temperature->getNight());
        $this->assertSame($temperature, $temperature->setNight($night));
        $this->assertEquals($night, $temperature->getNight());
    }

    /**
     * Test that attempting to set the night property with a non numeric
     * value results in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setNight
     */
    public function testSetNightWithNonNumericStringThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setNight('abcdefg');
    }

    /**
     * Test that we can get and set the evening value
     *
     * @covers \OpenWeatherMap\Entity\Temperature::getEvening
     * @covers \OpenWeatherMap\Entity\Temperature::setEvening
     */
    public function testGetSetEvening()
    {
        $evening = "4.23";
        $temperature = new Temperature();

        $this->assertNull($temperature->getEvening());
        $this->assertSame($temperature, $temperature->setEvening($evening));
        $this->assertEquals($evening, $temperature->getEvening());
    }

    /**
     * Test that attempting to set the evening property with a non numeric
     * value results in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setEvening
     */
    public function testSetEveningWithNonNumericStringThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setEvening('abcdef');
    }

    /**
     * Test that we can get and set the morning value
     *
     * @covers \OpenWeatherMap\Entity\Temperature::getMorning
     * @covers \OpenWeatherMap\Entity\Temperature::setMorning
     */
    public function testGetSetMorning()
    {
        $morning = "6.07";
        $temperature = new Temperature();

        $this->assertNull($temperature->getMorning());
        $this->assertSame($temperature, $temperature->setMorning($morning));
        $this->assertEquals($morning, $temperature->getMorning());
    }

    /**
     * Test that attempting to set the morning value with a non numeric
     * string results in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setMorning
     */
    public function testSetMorningWithNonNumericStringThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setMorning('abcdefg');
    }

    /**
     * Test that we can get and set the value
     *
     * @covers \OpenWeatherMap\Entity\Temperature::getValue
     * @covers \OpenWeatherMap\Entity\Temperature::setValue
     */
    public function testGetSetValue()
    {
        $value = "299.867";
        $temperature = new Temperature();

        $this->assertNull($temperature->getValue());
        $this->assertSame($temperature, $temperature->setValue($value));
        $this->assertEquals($value, $temperature->getValue());
    }

    /**
     * Test that attempting to set the value with a non scalar value results
     * in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setValue
     */
    public function testSetValueWithNonScalarThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setValue(new \stdClass());
    }

    /**
     * Test that attempting to set the value with a non numeric string
     * results in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setValue
     */
    public function testSetValueWithNonNumericStringThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setValue('abcdefg');
    }

    /**
     * Test that attempting to set the value with an array results
     * in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setValue
     */
    public function testSetValueWithArrayThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setValue(array());
    }

    /**
     * Test that we can get and set the unit
     *
     * @covers \OpenWeatherMap\Entity\Temperature::getUnit
     * @covers \OpenWeatherMap\Entity\Temperature::setUnit
     */
    public function testGetSetUnit()
    {
        $unit = "kelvin";
        $temperature = new Temperature();

        $this->assertNull($temperature->getUnit());
        $this->assertSame($temperature, $temperature->setUnit($unit));
        $this->assertEquals($unit, $temperature->getUnit());
    }

    /**
     * Test that attempting to set the unit value with a non string results
     * in an exception being thrown
     *
     * @expectedException InvalidArgumentException
     * @covers \OpenWeatherMap\Entity\Temperature::setUnit
     */
    public function testSetUnitWithNonStringThrowsException()
    {
        $temperature = new Temperature();
        $temperature->setUnit(new \stdClass());
    }
}
