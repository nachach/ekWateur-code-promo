<?php

namespace App\Service\Formater;

class JSONFormater implements Formater
{
    /**
     * @inheritDoc
     */
    public function format(array $datas): string
    {
        return json_encode($datas);
    }
}