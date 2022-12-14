<?php

namespace Phtfao\Panako\Support\Contracts;

interface RepositoryInterface
{
    public function __construct(ModelInterface $model);
    public function beginTransaction(): void;
    public function commit(): void;
    public function rollback(): void;
    public function get(int $idModel);
    public function getOrFail(int $idModel);

}