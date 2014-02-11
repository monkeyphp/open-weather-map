<?php
/**
 * ParameterFilter.php
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\InputFilter
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
namespace OpenWeatherMap\InputFilter;

use Zend\Filter\StringToLower;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\Callback;
use Zend\Validator\Digits;
use Zend\Validator\Exception\RuntimeException;
use Zend\Validator\InArray;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;

/**
 * ParameterFilter
 *
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\InputFilter
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 */
class ParameterFilter extends InputFilter
{
    /**
     * Constructor
     *
     * @param array $modes     Array of valid modes
     * @param array $units     Array of valid units
     * @param array $languages Array of valid languages
     *
     * @return void
     */
    public function __construct($modes = array(), $units = array(), $languages = array())
    {
        // mode
        $mode = new Input('mode');
        $mode->allowEmpty(false);
        $mode->getFilterChain()->attach(new StringToLower());
        $mode->getValidatorChain()->attach(
            new InArray(
                array(
                    'haystack' => $modes,
                    'messages' => array(
                        InArray::NOT_IN_ARRAY => 'The supplied mode is not valid'
                    )
                )
            ),
            true
        );
        // units
        $unit = new Input('units');
        $unit->allowEmpty(false);
        $unit->getFilterChain()->attach(new StringToLower());
        $unit->getValidatorChain()->attach(
            new InArray(
                array(
                    'haystack' => $units,
                    'messages' => array(
                        InArray::NOT_IN_ARRAY => 'The supplied unit is not valid'
                    )
                )
            ),
            true
        );
        // language
        $language = new Input('language');
        $language->allowEmpty(false);
        $language->getFilterChain()->attach(new StringToLower());
        $language->getValidatorChain()->attach(
            new InArray(
                array(
                    'haystack' => $languages,
                    'messages' => array(
                        InArray::NOT_IN_ARRAY => 'The supplied language is invalid'
                    )
                )
            ),
            true
        );
        // query
        $query = new Input('query');
        $query->setAllowEmpty(true);
        $query->getFilterChain()->attach(new StringToLower());
        $query->getValidatorChain()->attach(
            new StringLength(
                array(
                    'min' => 1,
                    'max' => 100,
                    'encoding' => 'UTF-8',
                    'messages' => array(
                        StringLength::INVALID => 'The supplied query should be a string',
                        StringLength::TOO_LONG => 'The supplied query should be no longer than 100 chars',
                        StringLength::TOO_SHORT => 'The supplied query should be at least 1 character'
                    )
                )
            ),
            true
        );
        // latitude
        $latitude = new Input('latitude');
        $latitude->setAllowEmpty(true);
        $latitude->getValidatorChain()->attach(
            new Regex(
                array(
                    'pattern' => '#\A[-|+]?[\d]{1,2}(?:[\.][\d]*)?\z#'
                )
            ),
            true
        );
        // longitude
        $longitude = new Input('longitude');
        $longitude->setAllowEmpty(true);
        $longitude->getValidatorChain()->attach(
            new Regex(
                array(
                    'pattern' => '#\A[-|+]?[\d]{1,3}(?:[\.][\d]*)?\z#'
                )
            ),
            true
        );
        // id
        $id = new Input('id');
        $id->setAllowEmpty(true);
        $id->getValidatorChain()->attach(
            new Digits(),
            true
        );
        // apiKey
        $apiKey = new Input('apiKey');
        $apiKey->setAllowEmpty(true);

        $this->add($mode)
            ->add($unit)
            ->add($language)
            ->add($query)
            ->add($latitude)
            ->add($longitude)
            ->add($id)
            ->add($apiKey);
    }

    /**
     * Is the data set valid?
     *
     * @throws RuntimeException
     * @return bool
     */
    public function isValid()
    {
        if (true === ($valid = parent::isValid())) {
            $validator = new Callback(array(
                'callback' => function ($values) {
                    if (isset($values['query']) ||
                        (isset($values['latitude']) && isset($values['longitude'])) ||
                        (isset($values['id']))
                    ) {
                        return true;
                    }
                },
                'messages' => array(
                    Callback::INVALID_VALUE => 'Requires a query, id, or latitude and longitude'
                )
            ));
            if (true === ($valid = ($validator->isValid($this->getValues())))) {
                $this->validInputs['atLeastOne'] = $validator;
            } else {
                $this->invalidInputs['atLeastOne'] = $validator;
            }
        }
        return $valid;
    }
}
