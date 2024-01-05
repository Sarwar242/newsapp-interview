<?php

namespace App\Library\Services;

use Exception;
use App\Library\Helper;
use App\Models\Comment;

class CommentService extends BaseService
{

    public function store(array $data): bool
    {
        try {
            $data['user_id'] = auth()->id();
            $this->data = Comment::create($data);

            return $this->handleSuccess('Comment Posted Successfully...');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}
