<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Factory;

abstract class BaseFactory
{
    abstract public function create(array $data);
}