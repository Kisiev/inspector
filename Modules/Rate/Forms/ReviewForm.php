<?php

namespace Modules\Rate\Forms;

use App\Components\Dto\BaseDto;
use App\Components\Forms\BaseForm;
use Illuminate\Validation\Rule;
use Modules\Rate\Constants\RateTypeConstant;
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
            'id'      => 'exists:review,id',
            'user_id' => 'required|exists:users,id',
            'shop_id' => 'required|exists:shop,id',
            'rate'    => 'required|integer|min:1|max:5',
            'type'    =>
                [
                    'required',
                    Rule::in(
                        RateTypeConstant::RATE_TYPE_GENERAL,
                        RateTypeConstant::RATE_TYPE_SERVICE,
                        RateTypeConstant::RATE_TYPE_TASTE,
                        RateTypeConstant::RATE_TYPE_WAITER
                    ),
                ],
        ];
    }
}