<?php
/**
 * Created by PhpStorm.
 * User: gwdev1
 * Date: 9/23/15
 * Time: 4:20 AM
 */

namespace app\Repositories;


use Illuminate\Support\Facades\DB;

class PostRepo {

    function findForNewsFeed($offset = 0, $limit = 15, $direction = 'DESC', $sortCol = 'created_at')
    {
        $q = DB::table('posts')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->select([
                    'posts.id',
                    'posts.content',
                    'posts.loves',
                    'posts.created_at',
                    'posts.user_id',
                    DB::raw("COUNT(comments.id) as commentsCount")
                ]
            );

        return $q->orderBy($sortCol, $direction)
            ->take($limit)
            ->skip($offset)
            ->groupBy('posts.id')
            ->get();
    }


    function findOneForNewsFeed($postId)
    {
        $q = DB::table('posts')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->select([
                    'posts.id',
                    'posts.content',
                    'posts.loves',
                    'posts.created_at',
                    'posts.user_id',
                    DB::raw("COUNT(comments.id) as commentsCount")
                ]
            );

        return $q->where('posts.id', $postId)->groupBy('posts.id')->first();
    }
}