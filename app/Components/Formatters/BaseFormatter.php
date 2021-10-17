<?php

namespace App\Components\Formatters;

use App\Exceptions\UnSuccessException;

abstract class BaseFormatter
{
    public abstract function attributes(): array;
    
    /**
     * @param array|object $data
     */
    public function serialize($data): array
    {
        if (is_array($data)) {
            return $this->arraySerialize($data);
        } else {
            return $this->objectSerialize($data);
        }
    }
    
    private function arraySerialize(array $data): array
    {
        $serializeData = [];
        
        foreach ($this->attributes() as $attribute) {
            if (isset($data[$attribute])) {
                $serializeData[$attribute] = $data[$attribute];
            } else {
                throw new UnSuccessException("Аттрибут: {$attribute} не найден");
            }
        }
        
        return $serializeData;
    }
    
    private function objectSerialize(object $data): array
    {
        $serializeData = [];
        
        foreach ($this->attributes() as $attribute) {
            if (isset($data->{$attribute})) {
                $serializeData[$attribute] = $data->{$attribute};
            } else {
                $serializeData[$attribute] = $this->getterForAttribute($data, $attribute);
            }
        }
        
        return $serializeData;
    }
    
    private function getterForAttribute(object $data, string $attribute): string
    {
        $getterName = 'get' . implode('', array_map('ucfirst', explode('_', $attribute)));
        if (method_exists($data, $getterName)) {
            return $data->{$getterName};
        }
        
        throw new UnSuccessException("Свойство: {$getterName} не найдено");
    }
}