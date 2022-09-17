<?php

namespace Phtfao\Panako\Core\User;

use Phtfao\Panako\Support\Repository\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $repository
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