<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\PromoCodeManager;

class PromoCodeManagerTest extends TestCase
{
    /**
     * @dataProvider jsonForPopulate
     */
    public function testPopulate($json)
    {
        $promoCodeManager = new PromoCodeManager("http://someurl");

        $promoCodesArray = json_decode($json, true);
        $promoCodes = $promoCodeManager->populate($json);

        $this->assertEquals(count($promoCodes), count($promoCodesArray));
        $this->assertEquals(current($promoCodes)->getCode(), $promoCodesArray[0]['code']);
    }

    public function jsonForPopulate()
    {
        return [
            ['[{"code":"EKWA_WELCOME1","discountValue":2,"endDate":"2019-10-04"}]'],
            ['[{"code":"EKWA_WELCOME2","discountValue":2,"endDate":"2019-10-04"},{"code":"ELEC_N_WOOD2","discountValue":1.5,"endDate":"2022-06-20"}]'],
            ['[{"code":"EKWA_WELCOME3","discountValue":2,"endDate":"2019-10-04"},{"code":"ELEC_N_WOOD3","discountValue":1.5,"endDate":"2022-06-20"},{"code":"ALL_20003","discountValue":2.75,"endDate":"2023-03-05"}]']
        ];
    }
}