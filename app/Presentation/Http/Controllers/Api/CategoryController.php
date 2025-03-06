<?php

namespace App\Presentation\Http\Controllers\Api;

use App\Domain\Models\Category;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::paginate(10))->additional([
            'status' => 'success',
            'code' => '200',
            'message' => 'Show all categories',
        ]);
    }
}
