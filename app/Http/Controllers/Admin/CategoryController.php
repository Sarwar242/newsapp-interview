<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Library\Services\CategoryService;

class CategoryController extends Controller
{
    use ApiResponse;

    private $category_service;

    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->category_service->dataTable();
        }

        return view('admin.pages.category.index');
    }

    public function create()
    {
        return view('admin.pages.category.create', [
            'categories' => Category::whereNull('parent_id')
                                            ->with('childrenCategories')
                                            ->with('childrenCategories.childrenCategories')
                                            ->with('childrenCategories.childrenCategories.childrenCategories')
                                            ->get(),
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $result = $this->category_service->store($request->validated());

        if ($result) {
            return redirect()->route('panel.categories')->with('success', $this->category_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->category_service->message);
    }

    public function edit(Category $category)
    {
        abort_unless($category, 404);

        return view('admin.pages.category.edit', [
            'category'   => $category,
            'categories' => Category::whereNull('parent_id')
                                            ->with('childrenCategories')
                                            ->with('childrenCategories.childrenCategories')
                                            ->with('childrenCategories.childrenCategories.childrenCategories')
                                            ->get(),
        ]);
    }

    public function update(Category $category, CategoryUpdateRequest $request)
    {
        abort_unless($category, 404);
        $result = $this->category_service->update($category, $request->validated());

        if ($result) {
            return redirect()->route('panel.categories', $category->id)->with('success', $this->category_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->category_service->message);
    }

    public function destroy(Category $category)
    {
        abort_unless($category, 404);

        if (count($category->children)) {
            return redirect()->back()->with('error', "Could not deleted! This category has child category.");
        }

        $category->delete();

        return redirect()->route('panel.categories')->with('success', __('Successfully Deleted'));
    }

    public function changeStatus(Request $request, Category $category)
    {
        abort_unless($category, 404);
        $result = $this->category_service->changeStatus($category);

        if ($result) {
            return redirect()->route('panel.categories')->with('success', $this->category_service->message);
        }

        return back()->withInput($request->all())->with('error', $this->category_service->message);
    }
}
