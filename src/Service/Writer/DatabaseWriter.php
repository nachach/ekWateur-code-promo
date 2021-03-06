<?php

namespace App\Service\Writer;

use App\Entity\PromoCode;
use App\Service\Formater\Formater;

class DatabaseWriter extends Writer
{
    /** @var mixed */
    protected $database;

    /**
     * DatabaseWriter constructor.
     * @param Formater $formater
     * @param $database
     */
    public function __construct(Formater $formater, $database)
    {
        parent::__construct($formater);
        $this->database = $database;
    }

    /**
     * @inheritDoc
     */
    public function write(array $datas)
    {
        return [];
        //TODO: Write in Database with doctrine or native PDO
    }
}