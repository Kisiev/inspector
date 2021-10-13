<?php

namespace App\Components\Dto;

abstract class BaseDto
{
    public abstract function loadFromArray(array $data): void;
    public abstract function getProperties(): array;
}