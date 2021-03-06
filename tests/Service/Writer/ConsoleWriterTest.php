<?php

namespace App\Tests\Service\Writer;

use App\Service\Formater\JSONFormater;
use App\Service\Formater\XMLFormater;
use App\Service\Formater\TEXTFormater;
use App\Service\Writer\ConsoleWriter;
use PHPUnit\Framework\TestCase;

class ConsoleWriterTest extends TestCase
{
    public function testConsoleWriteJson()
    {
        $datas = [
            "promoCode" => "1",
            "endDate" => "2",
            "discountValue" => "3",
            "compatibleOfferList" => [
                "name" => "4",
                "type" => "5"
            ],
        ];

        $writer = new ConsoleWriter(new JSONFormater(), true);
        $outputData = $writer->write($datas);

        $this->assertEquals($outputData, '{"promoCode":"1","endDate":"2","discountValue":"3","compatibleOfferList":{"name":"4","type":"5"}}');
    }

    public function TestConsoleWriteXml()
    {
        $datas = [
            "promoCode" => "1",
            "endDate" => "2",
            "discountValue" => "3",
            "compatibleOfferList" => [
                [
                    "name" => "4",
                    "type" => "5"
                ]
            ],
        ];

        $writer = new ConsoleWriter(new XMLFormater(), true);
        $outputData = $writer->write($datas);

        $this->assertEquals($outputData, '<?xml version="1.0"?>
<root><result><promoCode>1</promoCode><endDate>2</endDate><discountValue>3</discountValue><compatibleOfferList><name>4</name><type>5</type></compatibleOfferList></result></root>
');
    }

    public function testConsoleWriteText()
    {
        $datas = [
            "promoCode" => "1",
            "endDate" => "2",
            "discountValue" => "3",
            "compatibleOfferList" => [
                [
                    "name" => "4",
                    "type" => "5"
                ]
            ],
        ];

        $writer = new ConsoleWriter(new TextFormater(), true);
        $outputData = $writer->write($datas);

        $out = "promoCode : 1
endDate : 2
discountValue : 3
    name : 4
    type : 5";

        $this->assertEquals($outputData, $out);
    }
}