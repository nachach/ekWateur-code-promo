<?php

namespace App\Service\Writer;

use App\Service\Formater\Formater;

class FileWriter extends Writer
{
    /** @var string */
    protected $filePath;

    /**
     * FileWriter constructor.
     * @param Formater $formater
     * @param $filePath
     */
    public function __construct(Formater $formater, $filePath)
    {
        parent::__construct($formater);
        $this->filePath = $filePath;
    }

    /**
     * @inheritDoc
     */
    public function write (array $datas)
    {
        $f = fopen($this->filePath, 'w');

        fwrite($f, $this->formater->format($datas));

        fclose($f);
    }
}