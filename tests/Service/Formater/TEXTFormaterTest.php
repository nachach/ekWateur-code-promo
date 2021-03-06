<?php


namespace App\Tests\Service\Formater;

use App\Service\Formater\TEXTFormater;
use PHPUnit\Framework\TestCase;

class TEXTFormaterTest extends TestCase
{
    public function testFormat()
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

        $textFormater = new TEXTFormater();
        $text = $textFormater->format($datas);

        $out = "promoCode : 1
endDate : 2
discountValue : 3
    name : 4
    type : 5";

        $this->assertEquals($text, $out);
    }
}