<?php

namespace Modules\Rate\Http\Controllers;

use App\Components\Controllers\BaseApiController;
use App\Components\Search\BaseSearch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Rate\Dto\ShopSearchDto;
use Modules\Rate\Forms\ReviewForm;
use Modules\Rate\Resources\Shop\ShopCollection;

class ShopController extends BaseApiController
{
    private BaseSearch $search;
    
    public function __construct
    (
        BaseSearch $search
    ) {
        $this->search = $search;
    }
    
    public function index(Request $request): JsonResponse
    {
        $dto = new ShopSearchDto();
        $dto->loadFromArray($request->all());
        
        $shops = ShopCollection::make($this->search->search($dto));
        
        return $this->successResponse($shops);
    }
    
    public function review(Request $request): JsonResponse
    {
        $form = new ReviewForm();
        $form->load(
            [
                'user_id' => $request->user()->id ?? '',
                'shop_id' => $request->get('shop_id', ''),
                'rate'    => $request->get('rate', ''),
                'text'    => $request->get('text', ''),
            ]
        );
        
        $form->validate();
        $form->getDto();
    }
}