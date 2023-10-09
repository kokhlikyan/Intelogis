<?php

declare(strict_types=1);

namespace Intelogis\DeliveryCalculator\Model\Collection;

use Intelogis\DeliveryCalculator\Exception\EntityNotFoundException;
use Intelogis\DeliveryCalculator\Model\Entity\BaseModel;

abstract class BaseCollection
{
    protected array $data = [];

    public function add(BaseModel $model): BaseModel
    {
        return $this->data[$model->getId()] = $model;
    }

    public function remove(BaseModel $model): BaseModel
    {
        return $this->data[$model->getId()] = $model;
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getById(int $id): BaseModel
    {
        if ($this->exists($id)) {
            return $this->data[$id];
        }
        return throw new EntityNotFoundException("Can not find model with ID $id");
    }

    public function exists(int $id): bool
    {
        return isset($this->data[$id]);
    }

    public function getAll(): array
    {
        return $this->data;
    }
}