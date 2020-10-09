<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FilmRepository;
use App\Models\Film;
use App\Validators\FilmValidator;

/**
 * Class FilmRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FilmRepositoryEloquent extends BaseRepository implements FilmRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Film::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
