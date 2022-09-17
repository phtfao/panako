<?php

namespace Phtfao\Panako\Support\Repository;

use Phtfao\Panako\Broker\Model\Transaction;
use Phtfao\Panako\Support\Contracts\ModelInterface;
use Phtfao\Panako\Support\Exceptions\NotFoundException;
use Phtfao\Panako\Support\Repository\AbstractRepository;
use Phtfao\Panako\Support\Contracts\TransactionRepositoryInterface;

class TransactionRepository extends AbstractRepository implements TransactionRepositoryInterface
{
    public function __construct(
        private ModelInterface $model
    ) {}

    public function store(array $data): Transaction
    {
        return $this->model->create($data);
    }
    public function get(int $id): Transaction
    {
        return $this->model->find($id);
    }

    public function getOrFail(int $id): Transaction
    {
        return $this->model->findOrFail($id);
    }

    public function transfer(int $payer, int $payee, float $value)
    {
        $arrData = [
            'payer_id' => $payer,
            'payee_id' => $payee,
            'value' => $value
        ];

        return $this->store($arrData);
    }
}
