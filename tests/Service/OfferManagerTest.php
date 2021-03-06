<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\OfferManager;

class OfferManagerTest extends TestCase
{
    /**
     * @dataProvider jsonForPopulate
     */
    public function testPopulate($json)
    {
        $promoCodeManager = new OfferManager("http://someurl");

        $promoCodesArray = json_decode($json, true);
        $promoCodes = $promoCodeManager->populate($json);

        $this->assertEquals(count($promoCodes), count($promoCodesArray));
        $this->assertEquals(current($promoCodes)->getOfferName(), $promoCodesArray[0]['offerName']);
    }

    public function jsonForPopulate()
    {
        return [
            ['[{"offerType":"GAS","offerName":"EKWAG20001","offerDescription":"Une offre incroyable","validPromoCodeList":["EKWA_WELCOME","ALL_2000"]}]'],
            ['[{"offerType":"GAS","offerName":"EKWAG20002","offerDescription":"Une offre incroyable","validPromoCodeList":["EKWA_WELCOME","ALL_2000"]},{"offerType":"GAS","offerName":"EKWAG30002","offerDescription":"Une offre croustillante","validPromoCodeList":["EKWA_WELCOME","GAZZZZZZZZY"]}]'],
            ['[{"offerType":"GAS","offerName":"EKWAG20003","offerDescription":"Une offre incroyable","validPromoCodeList":["EKWA_WELCOME","ALL_2000"]},{"offerType":"GAS","offerName":"EKWAG30003","offerDescription":"Une offre croustillante","validPromoCodeList":["EKWA_WELCOME","GAZZZZZZZZY"]},{"offerType":"ELECTRICITY","offerName":"EKWAE20004","offerDescription":"Une offre du tonnerre","validPromoCodeList":["EKWA_WELCOME","ALL_2000","ELEC_IS_THE_NEW_GAS"]}]']
        ];
    }
}
