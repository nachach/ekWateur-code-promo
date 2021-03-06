<?php

namespace App\Tests\Entity;

use App\Entity\PromoCode;
use PHPUnit\Framework\TestCase;

class PromoCodeTest extends TestCase
{
    public function testIsValidTrue()
    {
        $promo = new PromoCode();
        $promo
            ->setCode("TEST_PROMO")
            ->setDiscountValue(2.5)
            ->setEndDate(new \DateTime("2022-01-01"))
            ;

        $isValid = $promo->isValid();

        $this->assertEquals(true, $isValid);
    }

    public function testIsValidFalse()
    {
        $promo = new PromoCode();
        $promo
            ->setCode("TEST_PROMO")
            ->setDiscountValue(2.5)
            ->setEndDate(new \DateTime("2012-01-01"))
        ;

        $isValid = $promo->isValid();

        $this->assertEquals(false, $isValid);
    }
}