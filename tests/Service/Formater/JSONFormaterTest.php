<?php

namespace App\Tests\Service\Formater;

use App\Service\Formater\JSONFormater;
use PHPUnit\Framework\TestCase;

class JSONFormaterTest extends TestCase
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

        $jsonFormater = new JSONFormater();
        $json = $jsonFormater->format($datas);

        $this->assertEquals($json, '{"promoCode":"1","endDate":"2","discountValue":"3","compatibleOfferList":{"name":"4","type":"5"}}');
    }
}