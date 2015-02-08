<?php
namespace Sejurplacut\Openweather\Adapter;

abstract class AdapterRequestAbstract
{
    const METHOD_TYPE_POST = 'POST';
    const METHOD_TYPE_GET  = 'GET';

    /**
     * @var array
     */
    protected $params = array();

    public function __construct($params)
    {
        $this->params = $params;
    }


    /**
     * @desc Builds request data. See returnRequest
     * @return array
     */
    abstract protected function buildRequest();

    /**
     * @param string $resource
     * @param string $method
     * @param array $data
     * @return array
     */
    final protected function returnRequest($resource, $method, $data = array())
    {
        if(     $method != self::METHOD_TYPE_GET
            &&  $method != self::METHOD_TYPE_POST)
        {
            $method = self::METHOD_TYPE_GET;
        }

        return array(
            'resource' => $resource,
            'method'   => $method,
            'data'     => $data,
        );
    }
}