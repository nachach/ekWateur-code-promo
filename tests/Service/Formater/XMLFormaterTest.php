<?php

namespace App\Tests\Service\Formater;

use App\Service\Formater\XMLFormater;
use PHPUnit\Framework\TestCase;


class XMLFormaterTest extends TestCase
{
    public function testFormat()
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

        $xmlFormater = new XMLFormater();
        $xml = $xmlFormater->format($datas);

        $this->assertEquals($xml, '<?xml version="1.0"?>
<root><result><promoCode>1</promoCode><endDate>2</endDate><discountValue>3</discountValue><compatibleOfferList><name>4</name><type>5</type></compatibleOfferList></result></root>
');
    }
}