<?php
namespace Sejurplacut\Openweather\Adapter;

abstract class AdapterResponseAbstract
{
    /**
     * @var mixed
     */
    protected $response = null;

    public function __construct($response, $params = array())
    {
        $this->response = $response;
    }

    /**
     * @desc Handles response
     */
    abstract protected function handleResponse();

    /**
     * @desc Analyses response code and throws custom exception.
     * @return bool
     * @throws mixed
     */
    final protected function analyseResponse()
    {
        if(!$this->response['valid'] || $this->response['status'] != 200)
        {
            throw $this->response['ex'];
        }

        return true;
    }
}