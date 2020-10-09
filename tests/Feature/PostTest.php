<?php

namespace Tests\Feature;

use App\Services\PostService;
use Tests\TestCase;
use App\Repositories\PostRepository;
use InvalidArgumentException;


class Post extends TestCase
{

    /**
     *
     * @test
     */
    public function shouldBeTrueWhenPostDataIsArray()
    {
        $stubPostRepository = $this->createMock(PostRepository::class); // dummie
        $postService = new PostService($stubPostRepository);

        $array = [
            'title' => 'teste', 
            'description' => 'desc'
        ];

        $valid = $postService->isArray($array);

        $this->assertTrue($valid);
    
    }

    /**
     *
     * @test
     */
    public function shouldBeFalseWhenPostDataIsNotArray()
    {
        $stubPostRepository = $this->createMock(PostRepository::class);
        $postService = new PostService($stubPostRepository);

        $array = 'foo';

        $valid = $postService->isArray($array);

        $this->assertFalse($valid);
    
    }

    /**
     *
     * @test
     */
    public function shouldThrowExceptionWhenPostDataIsNotArray()
    {
        $stubPostRepository = $this->createMock(PostRepository::class);
        $postService = new PostService($stubPostRepository);

        $array = 'foo';
        $this->expectException(InvalidArgumentException::class);

        $postService->store($array);
    
    }

    /**
     *
     * @test
     */
    public function shouldCreatedWhenPostDataIsArray()
    {
        $stubPostRepository = $this->createMock(PostRepository::class);
        $postService = new PostService($stubPostRepository);

        $stubPostRepository->expects($this->once())
            ->method('create');

        $array = [
            'title' => 'teste', 
            'description' => 'desc'
        ];

        $postService->store($array);
    
    }

    /**
     * @test
     */
    public function shouldBeOkWhenRequestedGetPosts()
    {
        $response = $this->get('/api/posts');

        $response->assertStatus(200);
    }
}
