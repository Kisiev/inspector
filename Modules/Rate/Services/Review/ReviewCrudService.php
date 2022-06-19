<?php

namespace Modules\Rate\Services\Review;

use App\Components\Dto\BaseDto;
use App\Components\Services\CrudService;
use Illuminate\Database\Eloquent\Model;
use Modules\Rate\Factories\ReviewFactory;
use Modules\Rate\Repositories\ReviewRepository;

class ReviewCrudService implements CrudService
{
    private ReviewRepository $repository;
    
    public function __construct(ReviewRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function create(BaseDto $dto): Model
    {
        $review = ReviewFactory::create();
        $review->fill($dto->getProperties());
        unset($review->id);
        $this->repository->save($review);
        return $review;
    }
    
    public function update(BaseDto $dto): Model
    {
        // TODO: Implement update() method.
    }
    
    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }
    
    public function show(int $id): Model
    {
        // TODO: Implement show() method.
    }
}