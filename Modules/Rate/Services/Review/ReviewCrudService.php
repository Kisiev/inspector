<?php

namespace Modules\Rate\Services\Review;

use App\Components\Dto\BaseDto;
use App\Components\Services\CrudService;
use Illuminate\Database\Eloquent\Model;
use Modules\Rate\Dto\ReviewDto;
use Modules\Rate\Events\RateEvent;
use Modules\Rate\Factories\ReviewFactory;
use Modules\Rate\Models\Review;
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
        /** @var Review $review */
        $review = ReviewFactory::create();
        $review->fill($dto->getProperties());
        unset($review->id);
        $this->repository->save($review);
        
        event(new RateEvent($review));
        return $review;
    }
    
    public function update(BaseDto|ReviewDto $dto): Model
    {
        $props = $dto->getProperties();
        /** @var Review $review */
        $review = $this->repository->findById($props['id']);
        $oldRate = $review->rate;
        $review->fill($props);
        $this->repository->save($review);
        
        event(new RateEvent($review, $oldRate));
        return $review;
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