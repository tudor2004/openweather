# Openweather API
Openweather API integration for Laravel framework. Get current weather or daily forecast using multiple parameters. 

# Installation

Using composer: 

    "require": {
        "sejurplacut/openweather": "dev-master"
    }

# Setup
1. Add the following to your config/app.php file in the service providers array

        'Sejurplacut\Openweather\Provider\OpenweatherServiceProvider'

2. Add the following to your config/app.php file in the aliases array

        'OpenWeather' => 'Sejurplacut\OpenWeather\Facades\Openweather'

3. Publish configuration file:

    php artisan config:publish sejurplacut/openweather


> **Note:**
Change the endpoint option with caution.

# Usage
Get the daily forecast. 

   
    $data = Openweather::getInstance()->getDailyForecast(array(
        'cityName'     => 'Paris',
        'latitude'     => '',
        'longitude'    => '',
        'days'         => ''
        'units'        => 'metric',
        'languageCode' => 'en',
    ));
Get the current weather conditions

    $data = Openweather::getInstance()->getCurrentWeather(array(
        'cityName' => 'Paris',
        'latitude' => '',
        'longitude' => '',
        'radius' => '',
        'units' => 'metric',
        'languageCode' => 'en',
    ));


