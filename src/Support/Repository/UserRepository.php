<?php

namespace Phtfao\Panako\Support\Repository;


use Phtfao\Panako\Broker\Model\User;
use Phtfao\Panako\Support\Contracts\ModelInterface;
use Phtfao\Panako\Support\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Phtfao\Panako\Support\Contracts\RepositoryInterface;
use Phtfao\Panako\Support\Contracts\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct(
        private ModelInterface $model
    ) {}

    public function get(int $id)
    {
        return $this->model->find($id);
    }

    public function getOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }
}
