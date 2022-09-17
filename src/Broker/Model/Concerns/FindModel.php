<?php

namespace Phtfao\Panako\Broker\Model\Concerns;

use Phtfao\Panako\Support\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait FindModel 
{
    public function find(int $id)
    {
        return parent::find($id);
    }

    public function findOrFail(int $id)
    {
        try {
            return parent::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException();
        }
    }
}