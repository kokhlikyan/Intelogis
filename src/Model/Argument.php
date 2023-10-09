<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Model;

use Intelogis\DeliveryCalculator\Exception\InvalidArgumentException;

class Argument
{
    const TYPE_FAST = 'fast';
    const TYPE_SLOW = 'slow';

    const ALLOWED_TYPES =
        [
            self::TYPE_FAST,
            self::TYPE_SLOW
        ];

    private string $type;
    private string $sourceKladr;
    private string $targetKladr;
    private float  $weight;
    private ?int $companyId;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(array $args) {
        $this->type = $args[1] ?? throw new InvalidArgumentException('Delivery type is required');

        if (!in_array($this->type, self::ALLOWED_TYPES)) {
            throw new InvalidArgumentException('Fast or Slow delivery is allowed');
        }

        $this->sourceKladr = $args[2] ?? throw new InvalidArgumentException('Source Kladr is required');
        $this->targetKladr = $args[3] ?? throw new InvalidArgumentException('Target Kladr is required');;
        $this->weight = isset($args[4]) ? floatval($args[4]) : throw new InvalidArgumentException('Weight is required');;
        $this->companyId = isset($args[5]) ? intval($args[5]) : null;
    }

    public function getCompanyId()
    {
        return $this->companyId;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSourceKladr(): string
    {
        return $this->sourceKladr;
    }

    public function getTargetKladr(): string
    {
        return $this->targetKladr;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }
}