<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Service\Delivery;

use Intelogis\DeliveryCalculator\DTO\DeliveryCalculationDTO;
use Intelogis\DeliveryCalculator\Model\Entity\Company;


class SlowDelivery extends Delivery
{
    const BASE_PRICE = 150;

    public function calculateCost(Company $company): DeliveryCalculationDTO
    {
        $url = $company->slowDeliveryUrl();

        //TODO need to get response from Company's API
       // $this->apiClient->post($url, $this->getData());

        $response = json_decode($this->getFakerData(), true);

        return new DeliveryCalculationDTO(
            $response["coefficient"] * self::BASE_PRICE,
            $response["date"],
            $response['error']
        );

    }

    private function getFakerData(): bool|string
    {
        return  json_encode([
            "coefficient" =>  $this->faker->randomFloat(),
            "date" => $this->faker->date(),
            "error" => $this->faker->sentence
        ]);
    }

}