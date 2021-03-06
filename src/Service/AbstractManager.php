<?php

namespace App\Service;

abstract class AbstractManager implements ManagerInterface
{
    /** @var string */
    protected $classname;

    /** @var string */
    protected $url;

    /**
     * AbstractManager constructor.
     * @param string $url
     * @param string $classname
     */
    public function __construct(string $url, string $classname)
    {
        $this->url = $url;
        $this->classname = $classname;
    }

    /**
     * Get data from ekwateur API
     * @return array
     * @throws \Exception
     */
    public function loadFromApi(): array
    {
        $response = $this->callApi();

        if (!empty($response)) {
            return $this->populate($response);
        } else {
           throw new \Exception(sprintf('Empty response from API %s', $this->classname));
        }
    }

    /**
     * construct the curl call
     * @return string
     */
    public function callApi(): string
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        return curl_exec($ch);
    }

    /**
     * populate Object with data get from api
     * @param string $json
     * @return array
     */
    abstract function populate(string $json): array;

}