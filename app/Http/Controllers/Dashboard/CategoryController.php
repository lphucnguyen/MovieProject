<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Commands\Category\CreateCategoryCommand;
use App\Commands\Category\DeleteCategoryCommand;
use App\Commands\Category\GetCategoryCommand;
use App\Commands\Category\UpdateCategoryCommand;
use App\DTOs\Category\CreateCategoryDTO;
use App\DTOs\Category\UpdateCategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateCategoryRequest;
use App\Http\Requests\Dashboard\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_categories,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_categories,guard:admin'])->only('index');
        $this->middleware(['permission:update_categories,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_categories,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $getCategoryCommand = new GetCategoryCommand($request->searchKey);
        $categories = Bus::dispatch($getCategoryCommand);

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $createCategoryCommand = new CreateCategoryCommand(
            CreateCategoryDTO::fromRequest($request)
        );
        Bus::dispatch($createCategoryCommand);

        session()->flash('success', 'Danh mục thêm thành công');
        return redirect()->route('dashboard.categories.index');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(string $uuid, UpdateCategoryRequest $request)
    {
        $updateCategoryCommand = new UpdateCategoryCommand(
            $uuid,
            UpdateCategoryDTO::fromRequest($request)
        );
        Bus::dispatch($updateCategoryCommand);

        session()->flash('success', 'Danh mục cập nhật thành công');
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(string $uuid)
    {
        $deleteCategoryCommand = new DeleteCategoryCommand($uuid);
        Bus::dispatch($deleteCategoryCommand);

        session()->flash('success', 'Danh mục xoá thành công');
        return redirect()->route('dashboard.categories.index');
    }
}
