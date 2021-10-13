<?php

namespace App\Components\Forms;

use App\Components\Dto\BaseDto;
use Illuminate\Support\Facades\Validator;

abstract class BaseForm implements ValidateFormInterface
{
    protected array $data = [];
    
    public function load(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function validate(): void
    {
        Validator::validate($this->data, $this->rules(), $this->messages(), $this->attributes());
    }
    
    public abstract function getDto(): BaseDto;

    protected function rules(): array
    {
        return [];
    }
    
    protected function messages(): array
    {
        return [];
    }
    
    protected function attributes(): array
    {
        return [];
    }
}