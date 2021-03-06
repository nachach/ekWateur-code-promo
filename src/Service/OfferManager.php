<?php

namespace App\Service;

use App\Entity\Offer;
use App\Entity\PromoCode;

class OfferManager extends AbstractManager
{
    /**
     * OfferManager constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        parent::__construct($url, Offer::class);
    }

    /**
     * @inheritDoc
     */
    public function populate(string $json): array
    {
        //JMS do it better :D
        $offersDecode = json_decode($json, true);

        $offers = [];
        foreach ($offersDecode as $offerDecode) {
            $offer = new Offer();
            $offer
                ->setOfferType($offerDecode['offerType'])
                ->setOfferName($offerDecode['offerName'])
                ->setOfferDescription($offerDecode['offerDescription'])
                ->setValidPromoCodeList($offerDecode['validPromoCodeList'])
            ;
            $offers[] = $offer;
        }

        return $offers;
    }

    /**
     * find offer linked to a promocode and build a response
     * @param PromoCode $code
     * @param array $offers
     * @return array
     */
    public function findLinkedOffers(PromoCode $code, array $offers) :array
    {
        $linkedOffers = [
            "promoCode" => $code->getCode(),
            "endDate" => $code->getEndDate()->format("Y-m-d"),
            "discountValue" => $code->getDiscountValue(),
            "compatibleOfferList" => [],
        ];
        /** @var Offer $offer */
        foreach ($offers as $k => $offer) {
            if (in_array($code->getCode(), $offer->getValidPromoCodeList())) {
                $linkedOffers["compatibleOfferList"][$k]["name"] = $offer->getOfferName();
                $linkedOffers["compatibleOfferList"][$k]["type"] = $offer->getOfferType();
            }
        }

        return $linkedOffers;
    }
}