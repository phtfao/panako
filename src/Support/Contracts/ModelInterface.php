<?php

namespace Phtfao\Panako\Support\Contracts;

interface ModelInterface
{
    public function find(int $id);
    public function findOrFail(int $id);
    public function create(array $data);
}