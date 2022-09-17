<?php

namespace Phtfao\Panako\Broker\Model;

use App\Models\User as UserModel;
use Phtfao\Panako\Broker\Model\Concerns\FindModel;
use Phtfao\Panako\Support\Contracts\ModelInterface;
use Phtfao\Panako\Support\Contracts\AccountInterface;

class User extends UserModel implements ModelInterface, AccountInterface
{
    use FindModel;
    
    public function deposit(float $amount): float
    {
        return ($this->balance += $amount);
    }

    public function withdraw(float $amount): float
    {
        return ($this->balance -= $amount);
    }


    public function create(array $data): bool
    {
        return parent::create($data);
    }
}