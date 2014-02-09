<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace OpenWeatherMap\InputFilter;

use Zend\Validator\Callback;
use Zend\InputFilter\InputFilter;

/**
 * Description of ParameterFilter
 *
 * @author David White <david@monkeyphp.com>
 */
class ParameterFilter extends InputFilter
{
    /**
     * Is the data set valid?
     *
     * @throws Exception\RuntimeException
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
