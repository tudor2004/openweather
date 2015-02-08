<?php namespace Sejurplacut\Openweather;

use GuzzleHttp\Client;
use Sejurplacut\Openweather\Adapter\DailyForecastRequest;
use Sejurplacut\Openweather\Adapter\DailyForecastResponse;
use Sejurplacut\Openweather\Adapter\CurrentWeatherRequest;
use Sejurplacut\Openweather\Adapter\CurrentWeatherResponse;

/**
 * Class Openweather
 *
 * @package Sejurplacut\Openweather
 */
class Openweather
{
    /**
     * @var Openweather
     */
    private static $instance = null;

    /**
     * @var array
     */
    private $options = array();

    /**
     * @var Client
     */
    private $client = null;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance()
    {
        if(!self::$instance instanceof Openweather)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @desc Make the request, return the response as array
     * @param array $requestData
     * @return array
     */
    private function call($requestData)
    {
        // init Guzzle client
        if(!$this->client instanceof Client)
        {
            $this->client = new Client(array(
                'base_url' => $this->options['endpoint'],
                'defaults' => array(
                    'timeout'           => 3.14,
                    'connect_timeout'   => 3.14
                )
            ));
        }

        try
        {
            $response = $this->client->get($requestData['resource'], $requestData['data']);
            return array(
                'valid' => true,
                'data' => $response->json(),
                'status' => $response->getStatusCode(),
            );
        }
        catch(\Exception $e)
        {
            return array(
                'valid' => false,
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
                'ex' => $e,
            );
        }

    }

    /**
     * @desc Initialize with options: endpoint,
     * @param array $options
     * @return Openweather
     */
    public function init($options = array())
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @desc Get the forecast weather conditions by the given params:
     *          - geographic coordinates: latitude, longitude
     *          - city id: cityId
     *          - city name: cityName (and maybe country code)
     *          - number of days: cnt
     *          - unit format: units (metric, imperial etc)
     *          - language code: languageCode
     * @param array $params
     * @return mixed
     * @throws mixed
     */
    public function getDailyForecast($params = array())
    {
        $requestAdapter = new DailyForecastRequest($params);
        $requestData = $requestAdapter->buildRequest();

        $response = $this->call($requestData);

        $responseAdapter = new DailyForecastResponse($response);
        return $responseAdapter->handleResponse();
    }

    /**
     * @desc Get the current weather condition by the given params:
     *          - geographic coordinates: latitude, longitude
     *          - city id: cityId
     *          - city name: cityName (and maybe country code)
     *          - unit format: units (metric, imperial etc)
     *          - search within radius: radius
     *          - language code: languageCode
     * @param array $params
     * @return array
     * @throws mixed
     */
    public function getCurrentWeather($params = array())
    {
        $requestAdapter = new CurrentWeatherRequest($params);
        $requestData = $requestAdapter->buildRequest();

        $response = $this->call($requestData);

        $responseAdapter = new CurrentWeatherResponse($response);
        return $responseAdapter->handleResponse();
    }
}