<?php

namespace App\Tests\Entity;

use App\Entity\Offer;
use App\Entity\PromoCode;
use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
    public function testCompareAddAndSetPromoCodeList()
    {
        $offer = new Offer();
        $offer
            ->setOfferName("Offer Name")
            ->setOfferType("Test Type")
            ->setOfferDescription("Offer for test")
            ;

        $offerComp = new Offer();
        $offerComp
            ->setOfferName("Offer Name")
            ->setOfferType("Test Type")
            ->setOfferDescription("Offer for test")
        ;

        $promoCodes = [];
        for ($i = 0; $i < 2; $i++)
        {
            $var = "promo".$i;
            $var = new PromoCode();
            $var
                ->setCode("TEST_PROMO".$i)
                ->setDiscountValue(2.5)
                ->setEndDate(new \DateTime("2022-01-01"))
            ;
            $offer->addPromoCode($var);
            $promoCodes[] = $var;
        }

        $offerComp->setValidPromoCodeList($promoCodes);


        $this->assertEquals(count($offerComp->getValidPromoCodeList()), count($offer->getValidPromoCodeList()));
        $this->assertEquals($offerComp, $offer);
    }
}