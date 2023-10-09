<?php


namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use Intelogis\DeliveryCalculator\Service\Delivery\FastDelivery;
use Intelogis\DeliveryCalculator\Model\Entity\Company;
use Intelogis\DeliveryCalculator\Model\Argument;
use Intelogis\DeliveryCalculator\Exception\ApplicationException;
use Intelogis\DeliveryCalculator\DTO\DeliveryCalculationDTO;

class FastDeliveryTest extends TestCase
{
    private FastDelivery $fastDelivery;

    public function setUp(): void
    {
        $argument = new Argument([1 => 'slow', 2 => '100051100000', 3 => '1000400000000', 4 => 1.2]);
        $this->fastDelivery = new FastDelivery($argument);
    }

    /**
     * @throws ApplicationException
     */
    public function testCalculateCost(): void
    {
        if (date('H:i:s') > date('18:00:00')) {
            $this->expectException(ApplicationException::class);
        }
        $company = new Company(1, 'testName', 'https://testurl.com', '/fast', '/slow');
        $cost = $this->fastDelivery->calculateCost($company);

        $this->assertInstanceOf(DeliveryCalculationDTO::class, $cost);
    }
}
