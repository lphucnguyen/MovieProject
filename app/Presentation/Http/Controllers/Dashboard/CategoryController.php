<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Domain\Models\Category;
use App\Application\Commands\Category\CreateCategoryCommand;
use App\Application\Commands\Category\DeleteCategoryCommand;
use App\Application\Commands\Category\GetCategoryCommand;
use App\Application\Commands\Category\UpdateCategoryCommand;
use App\Application\DTOs\Category\CreateCategoryDTO;
use App\Application\DTOs\Category\UpdateCategoryDTO;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Dashboard\CreateCategoryRequest;
use App\Presentation\Http\Requests\Dashboard\UpdateCategoryRequest;
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

        return redirect()->route('dashboard.categories.index')->withSuccess('Danh mục thêm thành công');
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

        return redirect()->route('dashboard.categories.index')->withSuccess('Danh mục cập nhật thành công');
    }

    public function destroy(string $uuid)
    {
        $deleteCategoryCommand = new DeleteCategoryCommand($uuid);
        Bus::dispatch($deleteCategoryCommand);

        return redirect()->route('dashboard.categories.index')->withSuccess('Danh mục xoá thành công');
    }
}
