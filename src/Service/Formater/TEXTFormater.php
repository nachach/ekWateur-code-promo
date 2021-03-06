<?php

namespace App\Service\Formater;

class TEXTFormater implements Formater
{
    /**
     * @inheritDoc
     */
    public function format(array $datas): string
    {
        $output = sprintf("promoCode : %s" . PHP_EOL, $datas['promoCode']);
        $output .= sprintf("endDate : %s" . PHP_EOL, $datas['endDate']);
        $output .= sprintf("discountValue : %s" . PHP_EOL, $datas['discountValue']);
        foreach ($datas['compatibleOfferList'] as $offer)
        {
            $output .= sprintf("    name : %s" . PHP_EOL, $offer['name']);
            $output .= sprintf("    type : %s", $offer['type']);
        }

        return $output;
    }
}