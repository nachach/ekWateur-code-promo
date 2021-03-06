<?php

namespace App\Service\Writer;

use App\Service\Formater\Formater;

abstract class Writer
{
    /** @var Formater */
    protected $formater;

    /**
     * Writer constructor.
     * @param Formater $formater
     */
    public function __construct(Formater $formater)
    {
        $this->formater = $formater;
    }

    /**
     * write data in good format
     * @param array $datas
     * @return mixed
     */
    abstract public function write(array $datas);
}