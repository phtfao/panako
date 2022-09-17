<?php

namespace Phtfao\Panako\Broker\Model;

use App\Model\Transaction as TransactionModel;
use Phtfao\Panako\Broker\Model\Concerns\FindModel;
use Phtfao\Panako\Support\Contracts\ModelInterface;


class Transaction extends TransactionModel implements ModelInterface
{
    use FindModel;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function create(array $data): bool
    {
        return parent::create($data);
    }
}