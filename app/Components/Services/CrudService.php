<?php

namespace App\Components\Services;

use App\Components\Dto\BaseDto;
use Illuminate\Database\Eloquent\Model;

interface CrudService
{
    public function create(BaseDto $dto): Model;
    public function update(BaseDto $dto): Model;
    public function delete(int $id): bool;
    public function show(int $id): Model;
}