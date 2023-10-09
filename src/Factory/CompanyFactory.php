<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Factory;

use Intelogis\DeliveryCalculator\Exception\InvalidCompanyDataException;
use Intelogis\DeliveryCalculator\Model\Entity\Company;

class CompanyFactory extends BaseFactory
{
    /**
     * @throws InvalidCompanyDataException
     */
    public function create(array $data): Company
    {
        $id = $data['id'] ?? null;
        $name = $data['name'] ?? null;
        $baseUrl = $data['baseUrl'] ?? null;
        $fastRelativeUrl = $data['fastRelativeUrl'] ?? null;
        $slowRelativeUrl = $data['slowRelativeUrl'] ?? null;

        if ($id && $name && $baseUrl && $fastRelativeUrl && $slowRelativeUrl) {
            return new Company($id, $name, $baseUrl, $fastRelativeUrl, $slowRelativeUrl);
        }

        throw new InvalidCompanyDataException('Company data is invalid');
    }
}