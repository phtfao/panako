<?php

namespace Phtfao\Panako\Broker\Model;

use App\Models\Transaction as TransactionModel;
use Phtfao\Panako\Broker\Model\Concerns\FindModel;
use Phtfao\Panako\Support\Contracts\ModelInterface;


class Transaction extends TransactionModel implements ModelInterface
{
    use FindModel;
    
    public function __construct()
    {
        parent::__construct();
    }

    public function create(array $data)
    {
        return parent::create($data);
    }
}