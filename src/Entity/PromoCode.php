<?php

namespace App\Entity;

class PromoCode
{
    /** @var string */
    protected $code;

    /** @var float */
    protected $discountValue;

    /** @var \DateTimeInterface */
    protected $endDate;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return PromoCode
     */
    public function setCode(string $code): PromoCode
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountValue(): float
    {
        return $this->discountValue;
    }

    /**
     * @param float $discountValue
     * @return PromoCode
     */
    public function setDiscountValue(float $discountValue): PromoCode
    {
        $this->discountValue = $discountValue;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getEndDate(): \DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * @param \DateTimeInterface $endDate
     * @return PromoCode
     */
    public function setEndDate(\DateTimeInterface $endDate): PromoCode
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * check if a Promocode is valid or not
     * @return bool
     */
    public function isValid(): bool
    {
        $now = new \DateTime();
        return $now < $this->getEndDate();
    }
}