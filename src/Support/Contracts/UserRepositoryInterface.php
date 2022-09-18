<?php

namespace Phtfao\Panako\Support\Contracts;

use Phtfao\Panako\Broker\Model\User;

interface UserRepositoryInterface
{
    public function __construct(User $model);

}