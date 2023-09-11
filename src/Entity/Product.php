<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Common\Filter\SearchFilterInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
/** A Product */
#[
    ApiResource(
        denormalizationContext: ['groups' => ['product.write']],
        normalizationContext: ['groups' => ['product.read']]
    ),
    ApiFilter(
        SearchFilter::class,
        properties: [
            'name' => SearchFilterInterface::STRATEGY_PARTIAL,
            'description' => SearchFilterInterface::STRATEGY_PARTIAL,
            'manufacturer.countryCode' => SearchFilterInterface::STRATEGY_EXACT,
            'manufacturer.id' => SearchFilterInterface::STRATEGY_EXACT,
        ]
    ),
    ApiFilter(
        OrderFilter::class,
        properties: ['issueDate']
    )
]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /** id of the product */
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    #[Assert\NotNull]
    #[
        Assert\NotNull,
        Groups(['product.read', 'product.write'])
    ]
    /** mpn of the product */
    private ?string $mpn = null;

    /** name of the product */
    #[ORM\Column(type: Types::STRING, length: 255)]
    #[
        Assert\NotNull,
        Groups(['product.read', 'product.write'])
    ]
    private string $name = '';

    /** description of the product */
    #[ORM\Column(type: Types::TEXT)]
    #[
        Assert\NotNull,
        Groups(['product.read', 'product.write'])
    ]
    private string $description = '';

    /** issueDate of the product */
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[
        Assert\NotNull,
        Groups(['product.read', 'product.write'])
    ]
    private ?\DateTimeInterface $issueDate = null;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class, inversedBy: 'products')]
    #[
        Assert\NotNull,
        Groups(['product.read', 'product.write'])
    ]
    /** manufacturer of the product */
    private ?Manufacturer $manufacturer = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getMpn(): ?string
    {
        return $this->mpn;
    }

    /**
     * @param string|null $mpn
     */
    public function setMpn(?string $mpn): void
    {
        $this->mpn = $mpn;
    }

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
     * @return \DateTimeInterface|null
     */
    public function getIssueDate(): ?\DateTimeInterface
    {
        return $this->issueDate;
    }

    /**
     * @param \DateTimeInterface|null $issueDate
     */
    public function setIssueDate(?\DateTimeInterface $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    /**
     * @return Manufacturer|null
     */
    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    /**
     * @param Manufacturer|null $manufacturer
     */
    public function setManufacturer(?Manufacturer $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }
}