<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\DTO;

use JsonSerializable;

final class DeliveryCalculationDTO implements JsonSerializable
{
    public function __construct(
        private float $price,
        private string $date,
        private string $error
    ){}

    public function jsonSerialize()
    {
        return [
            'price' => $this->price,
            'date' => $this->date,
            'error' => $this->error,
        ];
    }
}