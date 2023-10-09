<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Service\Delivery;

use Intelogis\DeliveryCalculator\Exception\ApplicationException;
use Intelogis\DeliveryCalculator\Model\Entity\Company;
use Intelogis\DeliveryCalculator\DTO\DeliveryCalculationDTO;

class FastDelivery extends Delivery
{
    /**
     * @throws ApplicationException
     */
    public function calculateCost(Company $company): DeliveryCalculationDTO
    {

        if (date('H:i:s') > date('18:00:00')) {
            throw new ApplicationException('After 18.00 applications are not accepted.');
        }

        $url = $company->fastDeliveryUrl();

        //TODO need to get response from Company's API
        //$this->apiClient->post($url, $this->getData());

        $response = json_decode($this->getFakerData(), true);

        $day = $response["period"];

        return new DeliveryCalculationDTO(
            $response["price"],
            date('Y-m-d', strtotime(date('Y-m-d') . " + $day day")),
            $response['error']
        );
    }

    private function getFakerData(): bool|string
    {
        return  json_encode([
            "price" =>  $this->faker->randomFloat(),
            "period" => $this->faker->randomDigitNotNull(),
            "error" => $this->faker->sentence
        ]);
    }
}