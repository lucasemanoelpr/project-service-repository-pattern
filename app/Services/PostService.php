<?php

namespace App\Services;
use App\Repositories\PostRepository;
use InvalidArgumentException;

class PostService
{
    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct(PostRepository $repository){
        $this->repository = $repository;
    }

    public function getAll()
    {
        $posts = $this->repository->all();
        return $posts;
    }

    public function store($data)
    {   
        if (!$this->isArray($data)) {
            throw new InvalidArgumentException('Data not okay');
        }
        
        $result = $this->repository->create($data);
        return $result;
    }

    public function isArray($data)
    {
        return is_array($data);
    }
}