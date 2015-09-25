<?php

namespace app\Http\Controllers;


use app\Dto\PostDto;
use app\Http\Requests;

class PostController extends Controller
{
    public function __construct(PostDto $postDto)
    {
        $this->postDto = $postDto;
    }

    public function posts() {
        return $this->postDto->findForNewsFeed();
    }

    public function countComments() {
        return 1;
    }
}
