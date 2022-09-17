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
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollback(): void
    {
        DB::rollBack();
    }

    public function get(int $idModel)
    {
        return $this->model->find($idModel);
    }

    public function getOrFail(int $idModel)
    {
        return $this->model->findOrFail($idModel);
    }
}
