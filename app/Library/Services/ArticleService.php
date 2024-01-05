<?php

namespace App\Library\Services;

use App\Library\Enum;
use Exception;
use App\Library\Helper;
use App\Models\Article;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class ArticleService extends BaseService
{
    private function actionHtml($row)
    {
        $actionHtml = '';

        if ($row->id) {
            $actionHtml = '
            <a class="dropdown-item" href="' . route('panel.news.articles.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>
            <a class="dropdown-item text-danger" onclick="confirmFormModal(\'' . route('panel.news.articles.delete', $row->id) . '\', \'Confirmation\', \'Are you sure to delete operation?\')"><i class="fas fa-trash-alt"></i> Delete</a>';
        } else {
            $actionHtml = '';
        }

        return '<div class="action dropdown">
                    <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fas fa-tools"></i> Action
                    </button>
                    <div class="dropdown-menu">
                        ' . $actionHtml . '
                    </div>
                </div>';
    }

    private function getSwitch($row)
    {
        $is_check = $row->is_active ? "checked" : "";
        $route = "'" . route('panel.news.articles.change_status', $row->id) . "'";

        return '<div class="custom-control custom-switch">
                    <input type="checkbox"
                        onchange="changeStatus(event, ' . $route . ')"
                        class="custom-control-input"
                        id="primarySwitch_' . $row->id . '" ' . $is_check . ' >
                    <label class="custom-control-label" for="primarySwitch_' . $row->id . '"></label>
                </div>';
    }

    public function dataTable()
    {
        $query = Article::with('category', 'author')->select('*');
        $data = $query->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('category_id', function ($row) {
                    return $row->category_id ? $row->category->name : 'N/A';
                })
                ->editColumn('author_id', function ($row) {
                    return $row?->author?->full_name;
                })
                ->addColumn('action', function ($row) {
                    return $this->actionHtml($row);
                })
                ->rawColumns(['action', 'category_id', 'author_id'])
                ->make(true);
    }

    public function store(array $data): bool
    {
        try {
            $data['author_id'] = auth()->id();
            if (isset($data['thumb'])) {
                $data['thumb'] = Helper::uploadImage($data['thumb'], Enum::USER_ARTICLE_THUMB_DIR, 500);
            }

            if (isset($data['picture'])) {
                $data['picture'] = Helper::uploadImage($data['picture'], Enum::USER_ARTICLE_DIR, 1000);
            }

            $this->data = Article::create($data);

            return $this->handleSuccess('Successfully created');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function update(Article $article, array $data): bool
    {
        try {
            $data['author_id'] = auth()->id();

            if (isset($data['thumb'])) {
                deleteFile($article->thumb);
                $data['thumb'] = Helper::uploadImage($data['thumb'], Enum::USER_ARTICLE_THUMB_DIR, 500);
            }

            if (isset($data['picture'])) {
                deleteFile($article->picture);
                $data['picture'] = Helper::uploadImage($data['picture'], Enum::USER_ARTICLE_DIR, 1000);
            }
            $this->data = $article->update($data);

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function changeStatus(Category $category): bool
    {
        try {
            $this->data = $category->update(['is_active' => !$category->is_active]);

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}
