<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Service\Client;

use Curl\Curl;
use Intelogis\DeliveryCalculator\Exception\CurlException;

class APIClient
{
    private Curl $_client;

    private static array $instances = [];

    protected function __clone() { }

    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instances[$subclass])) {
            self::$instances[$subclass] = new static();
        }
        return self::$instances[$subclass];
    }

    private function __construct()
    {
        $this->_client = new Curl();
    }

    /**
     * Get the response for API call GET method
     * @param string $path
     * @param array $params
     * @return false|string|null
     * @throws CurlException
     */
    public function post(string $path, array $params = []): bool|string|null
    {
        $curl =  $this->_client->post($path, $params);

        if($curl->error) {
            throw new CurlException($curl->getErrorMessage());
        }

        return $curl->response;
    }
}




