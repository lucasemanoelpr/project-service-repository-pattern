<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LivrosRepository;
use App\Models\Livros;
use App\Validators\LivrosValidator;

/**
 * Class LivrosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LivrosRepositoryEloquent extends BaseRepository implements LivrosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Livros::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LivrosValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
