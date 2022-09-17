<?php

namespace Phtfao\Panako\Broker\Model\Concerns;

use Phtfao\Panako\Support\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait FindModel 
{
    public function find(int $idModel)
    {
        return parent::find($idModel);
    }

    public function findOrFail(int $idModel)
    {
        try {
            return parent::findOrFail($idModel);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException();
        }
    }
}