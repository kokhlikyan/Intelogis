<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Model\Entity;

abstract class BaseModel
{
    public function getId(): int
    {
        return $this->id;
    }
}