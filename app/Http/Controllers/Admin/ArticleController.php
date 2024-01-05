<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Traits\ApiResponse;
use App\Library\Services\ArticleService;
use App\Models\Category;

class ArticleController extends Controller
{
    use ApiResponse;

    private $article_service;

    public function __construct(ArticleService $article_service)
    {
        $this->article_service = $article_service;
    }

    public function articles(Request $request)
    {
        if ($request->ajax()) {
            return $this->article_service->dataTable();
        }
        return view('admin.pages.article.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.article.create', [
            'categories' => Category::whereNull('parent_id')
                                            ->with('childrenCategories')
                                            ->with('childrenCategories.childrenCategories')
                                            ->with('childrenCategories.childrenCategories.childrenCategories')
                                            ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        // dd($request->validated());
        $result = $this->article_service->store($request->validated());

        if ($result) {
            return redirect()->route('panel.news.articles')->with('success', $this->article_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->article_service->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    public function edit(Article $article)
    {
        abort_unless($article, 404);
// dd($article->getImage());
        return view('admin.pages.article.edit', [
            'article'   => $article,
            'categories' => Category::whereNull('parent_id')
                                            ->with('childrenCategories')
                                            ->with('childrenCategories.childrenCategories')
                                            ->with('childrenCategories.childrenCategories.childrenCategories')
                                            ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        abort_unless($article, 404);
        $result = $this->article_service->update($article, $request->validated());

        if ($result) {
            return redirect()->route('panel.news.articles', $article->id)->with('success', $this->article_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->article_service->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        abort_unless($article, 404);
        $article->delete();

        return redirect()->route('panel.news.articles')->with('success', __('Successfully Deleted'));
    }
}
