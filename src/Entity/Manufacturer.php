<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
/** A manufacturer */
#[ApiResource]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** name of the manufacturer */
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name = '';

    /** description of the manufacturer */
    #[ORM\Column(type: Types::TEXT)]

    private string $description = '';

    /** countryCode of the manufacturer */
    #[ORM\Column(type: Types::STRING, length: 3)]

    private string $countryCode = '';

    /** dateTime of the manufacturer */
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}