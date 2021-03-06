<?php

namespace App\Service\Formater;

interface Formater
{
    /**
     * format data
     * @param array $datas
     * @return string
     */
    public function format(array $datas): string;
}