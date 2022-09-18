<?php

namespace Phtfao\Panako\Core\User;

use Phtfao\Panako\Support\Repository\UserRepository;
use Phtfao\Panako\Support\Contracts\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    public function get(int $id)
    {
        return $this->repository->get($id);
    }

    public function getOrFail(int $id)
    {
        return $this->repository->getOrFail($id);
    }
}