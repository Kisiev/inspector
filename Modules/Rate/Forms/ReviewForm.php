<?php

namespace Modules\Rate\Forms;

use App\Components\Dto\BaseDto;
use App\Components\Forms\BaseForm;
use Modules\Rate\Dto\ReviewDto;

class ReviewForm extends BaseForm
{
    public function getDto(): BaseDto
    {
        $dto = new ReviewDto();
        $dto->loadFromArray($this->data);
        
        return $dto;
    }
    
    protected function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'shop_id' => 'required|exists:shop,id',
            'rate'    => 'required|integer|min:1|max:5',
        ];
    }
}