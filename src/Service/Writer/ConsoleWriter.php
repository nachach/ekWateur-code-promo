<?php

namespace App\Service\Writer;

use App\Service\Formater\Formater;

class ConsoleWriter extends Writer
{
    /** @var string  */
    protected $decoration;

    /**
     * ConsoleWriter constructor.
     * @param Formater $formater
     * @param $decoration
     */
    public function __construct(Formater $formater, string $decoration)
    {
        parent::__construct($formater);
        $this->decoration = $decoration;
    }

    /**
     * @inheritDoc
     */
    public function write(array $datas)
    {
        // not very useful in this case ^^
        return $this->formater->format($datas);
    }

}