<?php
namespace Sejurplacut\Openweather\Adapter;

class CurrentWeatherRequest extends AdapterRequestAbstract
{
    /**
     * @return array
     */
    public function buildRequest()
    {
        $data = array();

        // lat,lng
        if( isset($this->params['latitude']) && strlen($this->params['latitude']) &&
            isset($this->params['longitude']) && strlen($this->params['longitude']))
        {
            $data['lat'] = $this->params['latitude'];
            $data['lon'] = $this->params['longitude'];
        }

        // units
        if(isset($this->params['units']) && strlen($this->params['units']))
        {
            $data['unit'] = $this->params['units'];
        }

        // city name and maybe country code
        if(isset($this->params['cityName']) && strlen($this->params['cityName']))
        {
            $data['q'] = $this->params['cityName'];

            if(isset($this->params['countryCode']) && strlen($this->params['countryCode']))
            {
                $data['q'] .= ',' . strtolower($this->params['countryCode']);
            }
        }

        // cityId
        if(isset($this->params['cityId']) && strlen($this->params['cityId']))
        {
            $data['id'] = $this->params['cityId'];
        }

        // radius
        if(isset($this->params['radius']) && strlen($this->params['radius']))
        {
            $data['cnt'] = $this->params['radius'];
        }

        // language
        if(isset($this->params['languageCode']) && strlen($this->params['languageCode']))
        {
            $data['lang'] = $this->params['languageCode'];
        }

        return $this->returnRequest('data/2.5/weather', 'GET', array('query' => $data));
    }
}