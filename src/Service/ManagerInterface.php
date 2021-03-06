<?php

namespace App\Service;

interface ManagerInterface
{
    /**
     * Get data from ekwateur API
     * @return array
     * @throws \Exception
     */
    public function loadFromApi(): array;

    /**
     * construct the curl call
     * @return string
     */
    public function callApi(): string;

    /**
     * populate Object with data get from api
     * @param string $json
     * @return array
     */
    public function populate(string $json): array;
}