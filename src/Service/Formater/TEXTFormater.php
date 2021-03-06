<?php

namespace App\Service\Formater;

class TEXTFormater implements Formater
{
    /**
     * @inheritDoc
     */
    public function format(array $datas): string
    {
        return print_r($datas);
    }
}