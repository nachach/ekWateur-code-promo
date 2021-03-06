<?php

namespace App\Service;

use App\Entity\PromoCode;

class PromoCodeManager extends AbstractManager
{
    /**
     * PromoCodeManager constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        parent::__construct($url, PromoCode::class);
    }

    /**
     * @inheritDoc
     */
    public function populate(string $json): array
    {
        //JMS do it better :D
        $codes = json_decode($json, true);

        $promoCodes = [];
        foreach ($codes as $code) {
            $promo = new PromoCode();
            $promo
                ->setCode($code['code'])
                ->setDiscountValue($code['discountValue'])
                ->setEndDate(new \DateTime($code['endDate']))
                ;
            $promoCodes[$code['code']] = $promo;
        }

        return $promoCodes;
    }
}