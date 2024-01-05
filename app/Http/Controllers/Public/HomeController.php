<?php

namespace App\Http\Controllers\Public;

use Carbon\Carbon;
use App\Models\User;
use App\Library\Enum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(6);

        return view('public.pages.index', compact('articles'));
    }

    public function article(Article $article)
    {
        abort_unless($article, 404);
        $article=$article->load('comments');

        return view('public.pages.article', compact('article'));
    }

    public function byCategory(Category $category)
    {
        abort_unless($category, 404);
        $activeCategory = $category;
        $categories = Category::with('articles')->get();

        return view('public.pages.category', compact(['activeCategory', 'categories']));
    }
}
