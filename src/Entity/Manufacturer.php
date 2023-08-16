<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

/** A manufacturer */
#[ApiResource]
class Manufacturer
{
    # id of the manufacturer
    private ?int $id = null;

    /** name of the manufacturer */
    private string $name = '';

    /** description of the manufacturer */
    private string $description = '';

    /** countryCode of the manufacturer */
    private string $countryCode = '';

    /** dateTime of the manufacturer */
    private ?\DateTimeInterface $listedTime = null;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getListedTime(): ?\DateTimeInterface
    {
        return $this->listedTime;
    }

    /**
     * @param \DateTimeInterface|null $listedTime
     */
    public function setListedTime(?\DateTimeInterface $listedTime): void
    {
        $this->listedTime = $listedTime;
    }
}