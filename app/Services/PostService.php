<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/26/15
 * Time: 3:42 AM
 */

namespace app\Services;


use app\Dto\PostDto;
use app\Models\Post;
use app\ResponseEntity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostService implements BaseService {

    public function __construct(PostDto $postDto) {
        $this->postDto = $postDto;
    }

    function save(array $params)
    {
        $response = new ResponseEntity();

        DB::transaction(function() use (&$response, $params)
        {
            if ($params['content']) {

                $p = new Post();
                $p->content = $params['content'];
                $p->user_id = Auth::user()->id;
                $ok = $p->save();

                if ($ok) { 
                    $response->setSuccess(true);
                    $response->setData(['post' => $this->postDto->findOneForNewsFeed($p->id)]);
                } else {
                    $response->setMessages(['Something went wrong!']);
                }
            } else {
                $response->setMessages(['Input something to post']);
            }
        });

        return $response;
    }
}