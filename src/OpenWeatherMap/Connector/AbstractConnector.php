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

use Exception;
use InvalidArgumentException;
use OpenWeatherMap\Exception\LockException;
use OpenWeatherMap\InputFilter\ParameterFilter;
use OpenWeatherMap\Lock\LockInterface;
use RuntimeException;
use Zend\Config\Reader\Json;
use Zend\Config\Reader\Xml;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\InputFilter\InputFilter;

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
     * Instance of ParameterFilter used to validate supplied parameters
     *
     * @var ParameterFilter
     */
    protected $inputFilter;

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
     * Url param for app id
     *
     * @var string
     */
    const PARAM_APPID = 'APPID';

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
    protected $serviceUri = 'http://api.openweathermap.org/data/2.5';

    /**
     * Url endpoint
     *
     * @var string
     */
    protected $endPoint = '';

    /**
     * The api key
     *
     * @var string|null
     */
    protected $apiKey;

    /**
     * Instance of LockInterface
     *
     * @var LockInterface
     */
    protected $lock;

    /**
     *
     */
    abstract public function getStrategy();

    /**
     * Return an instance of LockInterface
     *
     * @return LockInterface|null
     */
    public function getLock()
    {
        return $this->lock;
    }

    /**
     * Set the LockInterface instance
     *
     * @param LockInterface $lock The LockInterface instance
     *
     * @return AbstractConnector
     */
    public function setLock(LockInterface $lock)
    {
        $this->lock = $lock;
        return $this;
    }

    /**
     * Return the end point for this connector
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function getEndPoint()
    {
        if (! isset($this->endPoint)) {
            // @codeCoverageIgnoreStart
            throw new \RuntimeException('Endpoint not set');
            // @codeCoverageIgnoreEnd
        }
        return $this->endPoint;
    }

    /**
     * Return the api endpoint uri
     *
     * @return string
     */
    public function getUri()
    {
        return implode('/', array(
            $this->getServiceUri(),
            $this->getEndPoint()
        ));
    }

    /**
     * Return the service uri
     *
     * @return string
     */
    public function getServiceUri()
    {
        return $this->serviceUri;
    }

    /**
     * Return the array of accepted languages
     *
     * @return array
     */
    public function getLanguages()
    {
        return array(
            self::LANGUAGE_ENGLISH,    self::LANGUAGE_RUSSIAN,  self::LANGUAGE_ITALIAN,
            self::LANGUAGE_UKRANIAN,   self::LANGUAGE_SPANISH,  self::LANGUAGE_GERMAN,
            self::LANGUAGE_PORTUGUESE, self::LANGUAGE_ROMANIAN, self::LANGUAGE_POLISH,
            self::LANGUAGE_FINNISH,    self::LANGUAGE_DUTCH,    self::LANGUAGE_FRENCH,
            self::LANGUAGE_BULGARIAN,  self::LANGUAGE_SWEDISH,  self::LANGUAGE_TURKISH,
            self::LANGUAGE_CHINESE_TRADITIONAL, self::LANGUAGE_CHINESE_SIMPLIFIED
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
    public function getDefaultOptions()
    {
        return array(
            'mode'      => $this->getDefaultMode(),
            'language'  => $this->getDefaultLanguage(),
            'units'     => $this->getDefaultUnits()
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
            default:
                throw new InvalidArgumentException(sprintf('Supplied value %s is invalid', $mode));
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
     * Set the instance of Client to use
     *
     * @param Client $client
     *
     * @return AbstractConnector
     */
    public function setHttpClient(Client $client = null)
    {
        $this->httpClient = $client;
        return $this;
    }

    /**
     * Return an instance of Request
     *
     * @param string $uri    Uri instance
     * @param array  $params Array of uri params
     * @param string $method The request http method
     *
     * @throws Exception
     * @return Request
     */
    public function getRequest($uri, $params = array(), $method = Request::METHOD_GET)
    {
        try {
            $request = new Request();
            $request->setUri($uri);
            $request->getQuery()->fromArray($params);
            $request->setMethod($method);
            return $request;
        } catch (Exception $exception) {
            throw new Exception('Could not create Request instance', null, $exception);
        }
    }

    /**
     * Parse the options into an array of api parameters
     *
     * @param array $options
     *
     * @return array
     */
    public function parseParams($options = array())
    {
        $params = array();

        if (isset($options['mode'])) {
            $params[self::PARAM_MODE] = $options['mode'];
        }

        if (isset($options['units'])) {
            $params[self::PARAM_UNITS] = $options['units'];
        }

        if (isset($options['language'])) {
            $params[self::PARAM_LANGUAGE] = $options['language'];
        }

        if (isset($options['apiKey'])) {
            $params[self::PARAM_APPID] = $options['apiKey'];
        }

        return $params;
    }

    /**
     * Dispatch the supplied Request instance and return the Response
     *
     * @param Request $request The Request instance
     *
     * @return Response
     * @throws Exception
     * @throws RuntimeException
     */
    public function getResponse(Request $request)
    {
        try {
            $response = $this->getHttpClient()->dispatch($request);
            if (! $response->isSuccess()) {
                $statusCode = $response->getStatusCode();
                $reasonPhrase = $response->getReasonPhrase();
                $message = "[$statusCode] $reasonPhrase";
                throw new RuntimeException($message);
            }
            return $response;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Make a call to the OpenWeatherMap api
     *
     * @param array $options
     *
     * @return AbstractConnector|string
     * @throws Exception
     * @throws LockException
     */
    protected function query($options = array())
    {
        $options = array_merge($this->getDefaultOptions(), $options);
        $inputFilter = $this->getInputFilter()->setData($options);

        if (! $inputFilter->isValid()) {
            return $inputFilter->getMessages();
        }

        $options = $inputFilter->getValues();

        $params = $this->parseParams($options);

        if (isset($options['query'])) {
            $params[self::PARAM_QUERY] = $options['query'];
        } elseif (isset($options['latitude']) && isset($options['longitude'])) {
            $params[self::PARAM_LATITUDE]  = $options['latitude'];
            $params[self::PARAM_LONGITUDE] = $options['longitude'];
        } elseif (isset($options['id'])) {
            $params[self::PARAM_ID] = $options['id'];
        } else {
            throw new RuntimeException('A required value was not supplied');
        }

        $request = $this->getRequest($this->getUri(), $params);

        try {
            $lock = $this->getLock();
            if ($lock && (! $lock->acquire())) {
                throw new LockException('Could not obtain the lock');
            }

            $response = $this->getResponse($request);

            if ($lock) {
                $lock->release();
            }

            $body = $response->getBody();

            if ($options['mode'] === AbstractConnector::MODE_HTML) {
                return $body;
            }

            $reader = $this->getReader($options['mode']);
            $data = $reader->fromString($body);

            return $this->getStrategy()->hydrate($data);

        } catch (\Exception $exception) {
            if ($lock) {
                $lock->release();
            }
            throw $exception;
        }
    }

    /**
     * Return an instance of ParameterFilter
     *
     * @return ParameterFilter
     */
    public function getInputFilter()
    {
        if (! isset($this->inputFilter)) {
            $inputFilter = new ParameterFilter(
                $this->getModes(),
                $this->getUnits(),
                $this->getLanguages()
            );
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}
