<?php

namespace Phtfao\Panako\Support\Contracts;

use Phtfao\Panako\Broker\Model\Transaction;

interface TransactionRepositoryInterface
{
    public function __construct(Transaction $model);
    public function store(array $data);
    public function get(int $id);
    public function transfer(int $payer, int $payee, float $value);

}