<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    public function save(Model $model): void
    {
        $model->save();
        $model->refresh();
    }
    
    public abstract function getQuery(): Builder;
}