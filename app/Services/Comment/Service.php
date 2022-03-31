<?php

namespace App\Services\Comment;

use App\Models\Comment;

class Service
{
    public function store($data)
    {

        $comment = Comment::create($data);

    }

    public function update($comment, $data)
    {

        $comment->update($data);

    }

}
