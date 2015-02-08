<?php
namespace Sejurplacut\Openweather\Adapter;

class DailyForecastRequest extends AdapterRequestAbstract
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

        // days
        if(isset($this->params['days']) && strlen($this->params['days']))
        {
            $data['cnt'] = $this->params['days'];
        }

        // city id
        if(isset($this->params['cityId']) && strlen($this->params['cityId']))
        {
            $data['id'] = $this->params['cityId'];
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

        // language
        if(isset($this->params['languageCode']) && strlen($this->params['languageCode']))
        {
            $data['lang'] = $this->params['languageCode'];
        }

        return $this->returnRequest('data/2.5/forecast/daily', 'GET', array('query' => $data));
    }
}