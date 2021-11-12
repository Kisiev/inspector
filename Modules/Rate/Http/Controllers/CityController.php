<?php

namespace Modules\Rate\Http\Controllers;

use App\Components\Controllers\BaseApiController;
use App\Components\Search\BaseSearch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Rate\Dto\CitySearchDto;
use Modules\Rate\Resources\CityCollection;

class CityController extends BaseApiController
{
    private BaseSearch $search;
    
    public function __construct
    (
        BaseSearch $search
    )
    {
        $this->search = $search;
    }
    
    public function index(Request $request): JsonResponse
    {
        $dto = new CitySearchDto();
        $dto->loadFromArray($request->all());

        $cities = CityCollection::make($this->search->search($dto));

        return $this->successResponse($cities);
    }
}