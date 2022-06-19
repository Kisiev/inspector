<?php

namespace Modules\Rate\Http\Controllers;

use App\Components\Controllers\BaseApiController;
use App\Components\Search\BaseSearch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Rate\Dto\ShopSearchDto;
use Modules\Rate\Forms\ReviewForm;
use Modules\Rate\Resources\Shop\ShopCollection;
use Modules\Rate\Services\Review\ReviewCrudService;

class ShopController extends BaseApiController
{
    private BaseSearch $search;
    private ReviewCrudService $reviewCrudService;
    
    public function __construct
    (
        BaseSearch $search,
        ReviewCrudService $reviewCrudService
    ) {
        $this->search = $search;
        $this->reviewCrudService = $reviewCrudService;
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
                'id'      => $request->get('id'),
                'user_id' => $request->user()->id ?? '',
                'shop_id' => $request->get('shop_id'),
                'rate'    => $request->get('rate'),
                'text'    => $request->get('text'),
                'type'    => $request->get('type'),
            ]
        );
        
        $review = $this->reviewCrudService->create($form->getDto());
        return $this->successResponse($review);
    }
}