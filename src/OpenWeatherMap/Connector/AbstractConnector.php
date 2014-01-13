<?php
/**
 * AbstractConnector.php
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector
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
namespace OpenWeatherMap\Connector;

use InvalidArgumentException as InvalidArgumentException2;
use Zend\Config\Reader\Json;
use Zend\Config\Reader\Xml;
use Zend\Filter\Int;
use Zend\Filter\StringToLower;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Validator\Callback;
use Zend\Validator\Digits;
use Zend\Validator\Exception\InvalidArgumentException;
use Zend\Validator\InArray;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;

/**
 * AbstractConnector
 * 
 * @category   OpenWeatherMap
 * @package    OpenWeatherMap
 * @subpackage OpenWeatherMap\Connector
 * @author     David White [monkeyphp] <david@monkeyphp.com> 
 */
abstract class AbstractConnector
{
    /**
     * Instance of InputFilter used to validate supplied parameters
     * 
     * @var InputFilter
     */
    protected $inputFilter;
    
    /**
     * Instance of HydratorInterface
     * 
     * @var HydratorInterface
     */
    protected $hydrator;
    
    /**
     * Url param for query
     * 
     * @var string
     */
    const PARAM_QUERY = 'q';
    
    /**
     * Url param for latitude
     * 
     * @var string
     */
    const PARAM_LATITUDE  = 'lat';
    
    /**
     * Url param for longitude
     * 
     * @var string
     */
    const PARAM_LONGITUDE = 'lon';
    
    /**
     * Url param for id
     * 
     * @var string
     */
    const PARAM_ID = 'id';
    
    /**
     * Url param for mode
     * 
     * @var string
     */
    const PARAM_MODE = 'mode';
    
    /**
     * Url param for language
     * 
     * @var string
     */
    const PARAM_LANGUAGE = 'lang';
    
    /**
     * Url param for units
     * 
     * @var string
     */
    const PARAM_UNITS = 'units';
    
    /**
     * Xml
     * 
     * @var string
     */
    const MODE_XML = 'xml';
    
    /**
     * Html
     * 
     * @var string
     */
    const MODE_HTML = 'html';
    
    /**
     * Json
     * 
     * @var string
     */
    const MODE_JSON = 'json';
    
    /**
     * Instance of Client
     * 
     * @var Client
     */
    protected $httpClient;
    
    /**
     * The default mode value
     * 
     * @var string
     */
    protected $defaultMode;
    
    /**
     * The default language
     * 
     * @var string
     */
    protected $defaultLanguage;
    
    /**
     * The default units
     * 
     * @var string
     */
    protected $defaultUnits;
    
    /**
     * Languages
     * 
     * @var string
     */
    const LANGUAGE_ENGLISH             = 'en';
    const LANGUAGE_RUSSIAN             = 'ru';
    const LANGUAGE_ITALIAN             = 'it';
    const LANGUAGE_UKRANIAN            = 'ua';
    const LANGUAGE_SPANISH             = 'sp';
    const LANGUAGE_GERMAN              = 'de';
    const LANGUAGE_PORTUGUESE          = 'pt';
    const LANGUAGE_ROMANIAN            = 'ro';
    const LANGUAGE_POLISH              = 'pl';
    const LANGUAGE_FINNISH             = 'fi';
    const LANGUAGE_DUTCH               = 'nl';
    const LANGUAGE_FRENCH              = 'fr';
    const LANGUAGE_BULGARIAN           = 'bg';
    const LANGUAGE_SWEDISH             = 'se';
    const LANGUAGE_CHINESE_TRADITIONAL = 'zh_tw';
    const LANGUAGE_CHINESE_SIMPLIFIED  = 'zh_cn';
    const LANGUAGE_TURKISH             = 'tr';
    
    /**
     * Imperial
     * 
     * @var string
     */
    const UNITS_IMPERIAL = 'imperial';
    
    /**
     * Metric
     * 
     * @var string
     */
    const UNITS_METRIC = 'metric';
    
    /**
     * The url of the OpenWeatherMap api endpoint
     * 
     * @var string
     */
    protected $uri = 'http://api.openweathermap.org/data/2.5';
    
    /**
     * Url endpoint
     * 
     * @var string
     */
    protected $endPoint = '';
    
    /**
     * Return the api endpoint uri
     * 
     * @return string
     */
    public function getUri()
    {
        return implode('/', array($this->uri, $this->endPoint));
    }
    
    /**
     * Return the array of languages
     * 
     * @return array
     */
    public function getLanguages()
    {
        return array(
            self::LANGUAGE_ENGLISH, 
            self::LANGUAGE_RUSSIAN, 
            self::LANGUAGE_ITALIAN,
            self::LANGUAGE_UKRANIAN,
            self::LANGUAGE_SPANISH, 
            self::LANGUAGE_GERMAN, 
            self::LANGUAGE_PORTUGUESE,
            self::LANGUAGE_ROMANIAN, 
            self::LANGUAGE_POLISH, 
            self::LANGUAGE_FINNISH, 
            self::LANGUAGE_DUTCH,
            self::LANGUAGE_FRENCH, 
            self::LANGUAGE_BULGARIAN, 
            self::LANGUAGE_SWEDISH, 
            self::LANGUAGE_CHINESE_TRADITIONAL, 
            self::LANGUAGE_CHINESE_SIMPLIFIED,
            self::LANGUAGE_TURKISH
        );
    }
    
    /**
     * Return the default mode value
     * 
     * If the defaultMode is not set, this method will set it to 
     * WeatherConnector::MODE_XML
     * 
     * @return string
     */
    public function getDefaultMode()
    {
        if (! isset($this->defaultMode)) {
            $this->defaultMode = self::MODE_XML;
        }
        return $this->defaultMode;
    }
    
    /**
     * Set the default mode
     * 
     * Expects a value of 
     *  - self::MODE_XML 
     *  - self::MODE_HTML
     *  - self::MODE_JSON
     * 
     * @param string $mode The value to set the default mode to
     * 
     * @throws InvalidArgumentException
     */
    public function setDefaultMode($mode = null)
    {
        if (in_array($mode, $this->getModes())) {
            $this->defaultMode = $mode;
            return $this;
        }
        throw new InvalidArgumentException(sprintf("The supplied mode %s is not valid", $mode));
    }
    
    /**
     * Return an array of valid modes
     * 
     * @return array
     */
    public function getModes()
    {
        return array(
            self::MODE_XML,
            self::MODE_JSON, 
            self::MODE_HTML
        );
    }
    
    /**
     * Return an array of valid units
     * 
     * @return array
     */
    public function getUnits()
    {
        return array(
            self::UNITS_METRIC, 
            self::UNITS_IMPERIAL
        );
    }
    
    /**
     * Set the default language value
     * 
     * @param string $language
     * 
     * @throws InvalidArgumentException
     * @return WeatherConnector
     */
    public function setDefaultLanguage($language = null)
    {
        if (in_array($language, $this->getLanguages())) {
            $this->defaultLanguage = $language;
            return $this;
        }
        throw new InvalidArgumentException(sprintf('The supplied value %s is not valid', $language));
    }
    
    /**
     * Return the default language
     * 
     * This method will set the default language to english if the default
     * language has not already been set
     * 
     * @return string
     */
    public function getDefaultLanguage()
    {
        if (! isset($this->defaultLanguage)) {
            $this->defaultLanguage = self::LANGUAGE_ENGLISH;
        }
        return $this->defaultLanguage;
    }
    
    /**
     * Return the default units
     * 
     * This method will set the default units to metric if the default 
     * units has not already been set
     * 
     * @return string
     */
    public function getDefaultUnits()
    {
        if (! isset($this->defaultUnits)) {
            $this->defaultUnits = self::UNITS_METRIC;
        }
        return $this->defaultUnits;
    }

    /**
     * Set the default units value
     * 
     * @param string $defaultUnits
     * 
     * @throws InvalidArgumentException
     * @return WeatherConnector
     */
    public function setDefaultUnits($defaultUnits = null)
    {
        if (in_array($defaultUnits, $this->getUnits())) {
            $this->defaultUnits = $defaultUnits;
            return $this;
        }
        throw new InvalidArgumentException(sprintf('The supplied value %s is not valid', $defaultUnits));
    }
    
    /**
     * Return an array of default request params
     * 
     * @return array
     */
    protected function getDefaultOptions()
    {
        return array(
            'mode'     => $this->getDefaultMode(),
            'language' => $this->getDefaultLanguage(),
            'units'    => $this->getDefaultUnits()
        );
    }
    
    /**
     * Return the instance of Reader specified by the supplied parameter
     * 
     * @param string $mode
     * 
     * @throw \InvalidArgumentException
     * @return Xml|Json
     */
    public function getReader($mode = self::MODE_XML) 
    {
        switch ($mode) {
            case self::MODE_XML:
                return new Xml();
            case self::MODE_JSON:
                return new Json();
            case self::MODE_HTML:
                break;
            default:
                throw new InvalidArgumentException2(sprintf('Supplied value %s is invalid', $mode));
        }
    }
    
    /**
     * Return an instance of Client
     * 
     * @return Client
     */
    public function getHttpClient()
    {
        if (! isset($this->httpClient)) {
            $this->httpClient = new Client();
        }
        return $this->httpClient;
    }
    
    /**
     * Return an instance of Request
     * 
     * @param string $uri    Uri instance
     * @param array  $params Array of uri params
     * @param string $method The request http method
     * 
     * @return Request
     */
    public function getRequest($uri, $params = array(), $method = Request::METHOD_GET)
    {
        $request = new Request();
        $request->setUri($uri);
        $request->getQuery()->fromArray($params);
        $request->setMethod($method);
        return $request;
    }
    
    /**
     * Return an instance of \Zend\Stdlib\Hydrator\HydratorInterface
     * 
     * @return HydratorInterface
     */
    abstract public function getHydrator();
    
    /**
     * Return an instance of InputFilter
     * 
     * @return InputFilter
     */
    public function getInputFilter()
    {
        if (! isset($this->inputFilter)) {
            $inputFilter = new InputFilter();
            // mode
            $mode = new Input('mode');
            $mode->allowEmpty(false);
            $mode->getFilterChain()->attach(new StringToLower());
            $mode->getValidatorChain()->attach(
                new InArray(
                    array(
                        'haystack' => $this->getModes()
                    )
                )
            );
            
            // units
            $units = new Input('units');
            $units->allowEmpty(false);
            $units->getFilterChain()->attach(new StringToLower());
            $units->getValidatorChain()->attach(
                new InArray(
                    array(
                        'haystack' => $this->getUnits()
                    )
                )
            );
            
            // language
            $language = new Input('language');
            $language->allowEmpty(false);
            $language->getFilterChain()->attach(new StringToLower());
            $language->getValidatorChain()->attach(
                new InArray(
                    array(
                        'haystack' => $this->getLanguages()
                    )
                )
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
                        'encoding' => 'UTF-8'
                    )
                )
            );
            
            // latitude
            $latitude = new Input('latitude');
            $latitude->setAllowEmpty(true);
            $latitude->getValidatorChain()->attach(
                new Regex('#\A[-|+]?[\d]{1,2}(?:[\.][\d]*)?\z#')
            );
            
            // longitude
            $longitude = new Input('longitude');
            $longitude->setAllowEmpty(true);
            $longitude->getValidatorChain()->attach(
                new Regex('#\A[-|+]?[\d]{1,3}(?:[\.][\d]*)?\z#')
            );
            
            // id
            $id = new Input('id');
            $id->setAllowEmpty(true);
            $id->getFilterChain()->attach(new Int());
            $id->getValidatorChain()->attach(new Digits());
            
            // one
            $one = new Input();
            $one->setAllowEmpty(true);
            $one->setBreakOnFailure(true);
            $one->getValidatorChain()->attach(
                new Callback(
                    array(
                        'callback' => function($value, $context = array()) {
                            if (isset($context['query']) || 
                                (isset($context['latititude']) && isset($context['longitude'])) ||
                                (isset($context['id']))
                            ) {
                                return true;
                            }
                        }
                    )
                )
            );
            
            $inputFilter
                ->add($one)
                ->add($mode)
                ->add($units)
                ->add($language)
                ->add($query)
                ->add($latitude)
                ->add($longitude)
                ->add($id);
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}
