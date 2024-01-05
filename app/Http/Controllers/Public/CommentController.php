<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CommentStoreRequest;
use App\Http\Traits\ApiResponse;
use App\Library\Services\CommentService;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use ApiResponse;

    private $comment_service;

    public function __construct(CommentService $article_service)
    {
        $this->comment_service = $article_service;
    }

    public function store(CommentStoreRequest $request)
    {
        $result = $this->comment_service->store($request->validated());

        if ($result) {
            return redirect()->route('public.article', $request->article_id)->with('success', $this->comment_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->comment_service->message);
    }

    public function destroy(Comment $comment)
    {
        abort_unless($comment, 404);
        $comment->delete();

        return back();
    }
}
