<?php

namespace app\Dto;

use app\Repositories\EmployeeRepo;
use app\Repositories\PostRepo;
use Carbon\Carbon;

class PostDto
{

    public function __construct(PostRepo $postRepo, EmployeeRepo $employeeRepo)
    {
        $this->postRepo = $postRepo;
        $this->employeeRepo = $employeeRepo;
    }

    function findForNewsFeed($offset = 0, $limit = 15, $direction = 'DESC', $sortCol = 'created_at') {

        $data = [];

        $posts = $this->postRepo->findForNewsFeed($offset, $limit, $direction, $sortCol);
        if ($posts) {
            foreach($posts as $post) {
                $post->created_at = Carbon::parse($post->created_at)->diffForHumans();
                $post->user = $this->employeeRepo->findBy('user_id', $post->user_id, ['first_name', 'last_name']);
                $data[] = $post;
            }
        }
        return $data;
    }

    function findOneForNewsFeed($postId) {
        $p = $this->postRepo->findOneForNewsFeed($postId);
        if ($p) {
            $post['id'] = $p->id;
            $post['content'] = $p->content;
            $post['loves'] = $p->loves;
            $post['created_at'] = Carbon::parse($p->created_at)->diffForHumans();
            $post['commentsCount'] = $p->commentsCount;
            $post['user'] = $this->employeeRepo->findBy('user_id', $p->user_id, ['first_name', 'last_name']);
            return $post;
        }
        return [];
    }
}