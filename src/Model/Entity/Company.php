<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Model\Entity;

class Company extends BaseModel
{
    public function __construct(
        protected int $id,
        protected string $name,
        protected string $baseUrl,
        protected string $fastDeliveryRelativeUrl,
        protected string $slowDeliveryRelativeUrl
    ){}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function slowDeliveryUrl(): string
    {
        return urlencode(sprintf("%s/%s.", $this->baseUrl, $this->fastDeliveryRelativeUrl));
    }

    public function fastDeliveryUrl(): string
    {
        return urlencode(sprintf("%s/%s.", $this->baseUrl, $this->fastDeliveryRelativeUrl));
    }
}