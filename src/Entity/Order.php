<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrderRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
#[ApiResource]
class Order extends AbstractEntity
{
    #[ORM\Column(type: 'string', length: 10)]
    private ?string $customerTitle;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $customerFirstName;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $customerLastName;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $customerEmail;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $campaignTitle;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $campaignSummary;

    #[ORM\Column(type: 'date')]
    private ?DateTimeInterface $campaignStartDate;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $campaignEndDate;

    #[ORM\Column(type: 'integer')]
    private ?int $campaignProductLimit;

    #[ORM\Column(type: 'boolean')]
    private ?bool $campaignSpecial;

    #[ORM\Column(type: 'date')]
    private ?DateTimeInterface $deliveryStartDate;

    #[ORM\Column(type: 'date')]
    private ?DateTimeInterface $deliveryEndDate;

    #[ORM\Column(type: 'boolean')]
    private ?bool $permanentOrder;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'orders')]
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getCustomerTitle(): ?string
    {
        return $this->customerTitle;
    }

    public function setCustomerTitle(string $customerTitle): self
    {
        $this->customerTitle = $customerTitle;

        return $this;
    }

    public function getCustomerFirstName(): ?string
    {
        return $this->customerFirstName;
    }

    public function setCustomerFirstName(string $customerFirstName): self
    {
        $this->customerFirstName = $customerFirstName;

        return $this;
    }

    public function getCustomerLastName(): ?string
    {
        return $this->customerLastName;
    }

    public function setCustomerLastName(string $customerLastName): self
    {
        $this->customerLastName = $customerLastName;

        return $this;
    }

    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    public function setCustomerEmail(string $customerEmail): self
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    public function getCampaignTitle(): ?string
    {
        return $this->campaignTitle;
    }

    public function setCampaignTitle(string $campaignTitle): self
    {
        $this->campaignTitle = $campaignTitle;

        return $this;
    }

    public function getCampaignSummary(): ?string
    {
        return $this->campaignSummary;
    }

    public function setCampaignSummary(string $campaignSummary): self
    {
        $this->campaignSummary = $campaignSummary;

        return $this;
    }

    public function getCampaignStartDate(): ?DateTimeInterface
    {
        return $this->campaignStartDate;
    }

    public function setCampaignStartDate(DateTimeInterface $campaignStartDate): self
    {
        $this->campaignStartDate = $campaignStartDate;

        return $this;
    }

    public function getCampaignEndDate(): ?string
    {
        return $this->campaignEndDate;
    }

    public function setCampaignEndDate(string $campaignEndDate): self
    {
        $this->campaignEndDate = $campaignEndDate;

        return $this;
    }

    public function getCampaignProductLimit(): ?int
    {
        return $this->campaignProductLimit;
    }

    public function setCampaignProductLimit(int $campaignProductLimit): self
    {
        $this->campaignProductLimit = $campaignProductLimit;

        return $this;
    }

    public function getCampaignSpecial(): ?string
    {
        return $this->campaignSpecial;
    }

    public function setCampaignSpecial(string $campaignSpecial): self
    {
        $this->campaignSpecial = $campaignSpecial;

        return $this;
    }

    public function getDeliveryStartDate(): ?DateTimeInterface
    {
        return $this->deliveryStartDate;
    }

    public function setDeliveryStartDate(DateTimeInterface $deliveryStartDate): self
    {
        $this->deliveryStartDate = $deliveryStartDate;

        return $this;
    }

    public function getDeliveryEndDate(): ?DateTimeInterface
    {
        return $this->deliveryEndDate;
    }

    public function setDeliveryEndDate(DateTimeInterface $deliveryEndDate): self
    {
        $this->deliveryEndDate = $deliveryEndDate;

        return $this;
    }

    public function isPermanentOrder(): ?bool
    {
        return $this->permanentOrder;
    }

    public function setPermanentOrder(bool $permanentOrder): self
    {
        $this->permanentOrder = $permanentOrder;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }
}
