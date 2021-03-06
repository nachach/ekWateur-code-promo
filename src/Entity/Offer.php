<?php

namespace App\Entity;

class Offer
{
    /** @var string */
    protected $offerType;

    /** @var string */
    protected $offerName;

    /** @var string */
    protected $offerDescription;

    /** @var  PromoCode[]*/
    protected $validPromoCodeList;

    /**
     * Offer constructor.
     */
    public function __construct()
    {
        //Change array bu ArrayCollection if we can import the good dependence
        $this->validPromoCodeList = [];
    }

    /**
     * @return string
     */
    public function getOfferType(): string
    {
        return $this->offerType;
    }

    /**
     * @param string $offerType
     * @return Offer
     */
    public function setOfferType(string $offerType): Offer
    {
        $this->offerType = $offerType;
        return $this;
    }

    /**
     * @return string
     */
    public function getOfferName(): string
    {
        return $this->offerName;
    }

    /**
     * @param string $offerName
     * @return Offer
     */
    public function setOfferName(string $offerName): Offer
    {
        $this->offerName = $offerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getOfferDescription(): string
    {
        return $this->offerDescription;
    }

    /**
     * @param string $offerDescription
     * @return Offer
     */
    public function setOfferDescription(string $offerDescription): Offer
    {
        $this->offerDescription = $offerDescription;
        return $this;
    }

    /**
     * @return PromoCode[]
     */
    public function getValidPromoCodeList(): array
    {
        return $this->validPromoCodeList;
    }

    /**
     * @param PromoCode[] $validPromoCodeList
     * @return Offer
     */
    public function setValidPromoCodeList(array $validPromoCodeList): Offer
    {
        $this->validPromoCodeList = $validPromoCodeList;
        return $this;
    }

    private function transformToStorage(array $list): \SplObjectStorage
    {
        $storage = new \SplObjectStorage;

        foreach ($list as $item)
        {
            $storage->attach($item);
        }

        return $storage;
    }

    /**
     * @param PromoCode $code
     * @return Offer
     */
    public function addPromoCode(PromoCode $code): Offer
    {
        $storage = $this->transformToStorage($this->getValidPromoCodeList());

        if (!$storage->contains($code))
        {
            $this->validPromoCodeList[] = $code;
        }

        return $this;
    }
}