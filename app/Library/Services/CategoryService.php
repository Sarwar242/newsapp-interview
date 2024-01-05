<?php

namespace App\Library\Services;

use Exception;
use App\Library\Helper;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

class CategoryService extends BaseService
{
    private function actionHtml($row)
    {
        $actionHtml = '';

        if ($row->id) {
            $actionHtml = '
            <a class="dropdown-item" href="' . route('panel.category.update', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>
            <a class="dropdown-item text-danger" href="' . route('panel.category.delete', $row->id) . '" ><i class="fas fa-trash-alt"></i> Delete</a>';
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
        $route = "'" . route('panel.category.change_status', $row->id) . "'";

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
        $query = Category::with('parent')->select('*');
        $data = $query->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('parent_id', function ($row) {
                    return $row->parent_id ? $row->parent->name : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return $this->actionHtml($row);
                })
                ->editColumn('is_active', function ($row) {
                    return $this->getSwitch($row);
                })
                ->rawColumns(['action', 'is_active'])
                ->make(true);
    }

    public function store(array $data): bool
    {
        try {
            $this->data = Category::create($data);

            return $this->handleSuccess('Successfully created');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function update(Category $category, array $data): bool
    {
        try {
            $this->data = $category->update($data);

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
