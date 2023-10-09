<?php

namespace Tests\Unit\Factory;

use Intelogis\DeliveryCalculator\Exception\InvalidCompanyDataException;
use PHPUnit\Framework\TestCase;
use Intelogis\DeliveryCalculator\Factory\CompanyFactory;
use Intelogis\DeliveryCalculator\Model\Entity\Company;

class CompanyFactoryTest extends TestCase
{
    private CompanyFactory $companyFactory;

    public function setUp(): void
    {
        $this->companyFactory = new CompanyFactory();
    }

    public function testCreateSuccessful(): void
    {
        $company = $this->companyFactory->create([
            'id' => 8,
            'name' => 'testName',
            'baseUrl' => 'https://testBaseUrl',
            'fastRelativeUrl' => '123456789',
            'slowRelativeUrl' => '12345678910'
        ]);
        $this->assertInstanceOf(Company::class, $company);

    }

    public function testCreateFailed(): void
    {
        $this->expectException(InvalidCompanyDataException::class);

        $company = $this->companyFactory->create([
            'id' => 8,
            'name' => null,
            'baseUrl' => 'https://testBaseUrl',
            'fastRelativeUrl' => '123456789',
            'slowRelativeUrl' => '12345678910'
        ]);

    }
}
