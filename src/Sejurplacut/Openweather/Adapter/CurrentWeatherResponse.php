<?php
namespace Sejurplacut\Openweather\Adapter;

class CurrentWeatherResponse extends AdapterResponseAbstract
{
    /**
     * @return mixed
     */
    public function handleResponse()
    {
        if($this->analyseResponse())
        {
            return $this->response['data'];
        }
    }
}