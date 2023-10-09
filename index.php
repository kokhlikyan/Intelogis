<?php

use Intelogis\DeliveryCalculator\Model\Argument;
use Intelogis\DeliveryCalculator\Model\Entity\Company;
use Intelogis\DeliveryCalculator\Service\Delivery\FastDelivery;
use Intelogis\DeliveryCalculator\Service\Delivery\SlowDelivery;
use Intelogis\DeliveryCalculator\Service\Processor\FileProcessor;

require_once 'vendor/autoload.php';

try {

    $table = new LucidFrame\Console\ConsoleTable();
    $table
        ->addHeader('Company name')
        ->addHeader('Price')
        ->addHeader('Date')
        ->addHeader('Error')
    ;

    $args = new Argument($argv);

    $delivery = match ($args->getType()) {
        'fast' => new FastDelivery($args),
        default => new SlowDelivery($args)
    };

    $fileProcessor = new FileProcessor('data.json');
    $companies = $fileProcessor->processFile();

    $companiesArray = $args->getCompanyId() ? [$companies->getById($args->getCompanyId())] : $companies->getAll();

    foreach ($companiesArray as $company) {
        /* @var $company Company */
        $deliveryData = $delivery->calculateCost($company)->jsonSerialize();

        $table
            ->addRow()
            ->addColumn($company->getName())
            ->addColumn($deliveryData['price'])
            ->addColumn($deliveryData['date'])
            ->addColumn($deliveryData['error']);
    }

    $table->display();

} catch (Exception $e) {
    echo $e->getMessage();
}
