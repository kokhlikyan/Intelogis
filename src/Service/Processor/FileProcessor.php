<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Service\Processor;

use Intelogis\DeliveryCalculator\Exception\FileNotFoundException;
use Intelogis\DeliveryCalculator\Exception\InvalidCompanyDataException;
use Intelogis\DeliveryCalculator\Factory\CompanyFactory;
use Intelogis\DeliveryCalculator\Model\Collection\BaseCollection;
use Intelogis\DeliveryCalculator\Model\Collection\CompanyCollection;

class FileProcessor
{
    /**
     * @throws FileNotFoundException
     */
    public function __construct(
        protected string $path
    ){
        $this->fileExists();
    }

    /**
     * @throws InvalidCompanyDataException
     */
    public function processFile(): BaseCollection
    {
        $json = file_get_contents($this->path);
        $companies = json_decode($json,true);

        $collection = new CompanyCollection();
        $factory = new CompanyFactory();

        foreach ($companies as $company) {
            $collection->add($factory->create($company));
        }

        return $collection;
    }

    /**
     * @throws FileNotFoundException
     */
    private function fileExists(): void
    {
        if (!file_exists($this->path)) {
            throw new FileNotFoundException("File on path $this->path does not exist.");
        }
    }
}