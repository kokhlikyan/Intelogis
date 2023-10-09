<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Service\Delivery;

use Faker\Factory;
use Faker\Generator;
use Intelogis\DeliveryCalculator\Exception\ApplicationException;
use Intelogis\DeliveryCalculator\Model\Argument;
use Intelogis\DeliveryCalculator\Model\Entity\Company;
use Intelogis\DeliveryCalculator\DTO\DeliveryCalculationDTO;
use Intelogis\DeliveryCalculator\Service\Client\APIClient;

abstract class Delivery
{
    protected Argument $argument;
    protected APIClient $apiClient;
    protected Generator $faker;

    public function __construct(Argument $argument)
    {
        $this->apiClient = APIClient::getInstance();
        $this->faker = Factory::create();
        $this->argument = $argument;
    }

    abstract public function calculateCost(Company $company): DeliveryCalculationDTO;

    protected function getData(): array
    {

        return [
            $this->argument->getSourceKladr(),
            $this->argument->getTargetKladr(),
            $this->argument->getWeight()
        ];
    }
}