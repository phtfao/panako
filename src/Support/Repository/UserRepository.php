<?php

namespace Phtfao\Panako\Support\Repository;


use Phtfao\Panako\Broker\Model\User;
use Phtfao\Panako\Support\Contracts\ModelInterface;
use Phtfao\Panako\Support\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Phtfao\Panako\Support\Contracts\RepositoryInterface;

class UserRepository extends AbstractRepository implements RepositoryInterface
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
        //dd(get_class($this->model), get_class_methods($this->model));
        // try {
             return $this->model->findOrFail($id);
        // } catch (ModelNotFoundException $e) {
        //     throw new NotFoundException();
        // }
    }
}
