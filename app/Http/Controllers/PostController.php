<?php

namespace app\Http\Controllers;


use app\Dto\PostDto;
use app\Http\Requests;
use app\Services\PostService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function __construct(PostDto $postDto, PostService $postService)
    {
        $this->postDto = $postDto;
        $this->postService = $postService;
    }

    public function posts() {
        return $this->postDto->findForNewsFeed();
    }

    public function store() {
        return $this->postService->save(Input::all())->toArray();
    }

    public function find($postId) {
        return $this->postDto->findOneForNewsFeed($postId);
    }
}
