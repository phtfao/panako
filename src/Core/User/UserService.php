<?php

namespace Phtfao\Panako\Core\User;

use Phtfao\Panako\Support\Repository\UserRepository;
use Phtfao\Panako\Support\Contracts\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    public function get(int $idUser)
    {
        return $this->repository->get($idUser);
    }

    public function getOrFail(int $idUser)
    {
        return $this->repository->getOrFail($idUser);
    }
}