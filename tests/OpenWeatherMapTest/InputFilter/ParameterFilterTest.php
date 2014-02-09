<?php
/**
 * ParameterFilterTest.php
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\InputFilter
 * @author   David White [monkeyphp] <david@monkeyphp.com>
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
namespace OpenWeatherMapTest\InputFilter;

use OpenWeatherMap\InputFilter\ParameterFilter;
use PHPUnit_Framework_TestCase;

/**
 * ParameterFilterTest
 *
 * @category   OpenWeatherMapTest
 * @package    OpenWeatherMapTest
 * @subpackage OpenWeatherMapTest\InputFilter
 * @author   David White [monkeyphp] <david@monkeyphp.com>
 */
class ParameterFilterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers \OpenWeatherMap\InputFilter\ParameterFilter::__construct
     */
    public function test__construct()
    {
        $modes = array('json');
        $units = array('metric');
        $languages = array('en');
        $inputFilter = new ParameterFilter($modes, $units, $languages);

        $this->assertInstanceOf('\OpenWeatherMap\InputFilter\ParameterFilter', $inputFilter);
    }
    
    /**
     * Test that we can validate the values successfully
     *
     * @covers \OpenWeatherMap\InputFilter\ParameterFilter::isValid
     */
    public function testIsValidTrue()
    {
        $modes = array('json');
        $units = array('metric');
        $languages = array('en');
        $inputFilter = new ParameterFilter($modes, $units, $languages);

        $values = array(
            'mode' => 'json',
            'units' => 'metric',
            'language' => 'en',
            'id' => 123
        );
        $inputFilter->setData($values);

        $this->assertTrue($inputFilter->isValid());

    }

    /**
     * Test that we can validate the values successfully
     *
     * @covers \OpenWeatherMap\InputFilter\ParameterFilter::isValid
     */
    public function testIsValidFalse()
    {
        $modes = array('json');
        $units = array('metric');
        $languages = array('en');
        $inputFilter = new ParameterFilter($modes, $units, $languages);

        $values = array(
            'mode' => 'json',
            'units' => 'metric',
            'language' => 'en'
        );
        $inputFilter->setData($values);
        $this->assertFalse($inputFilter->isValid());
    }
}
