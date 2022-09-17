<?php

namespace Phtfao\Panako\Support\Repository;

use Illuminate\Support\Facades\DB;
use Phtfao\Panako\Support\Contracts\ModelInterface;
use Phtfao\Panako\Support\Contracts\RepositoryInterface;

class AbstractRepository implements RepositoryInterface
{
    public function __construct(
        private ModelInterface $model
    ) {}
    public function beginTransaction(): void
    {
        //DB::beginTransaction();
    }

    public function commit(): void
    {
        //DB::commit();
    }

    public function rollback(): void
    {
        //DB::rollBack();
    }

    public function get(int $id)
    {
        return $this->model->find($id);
    }

    public function getOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }
}
