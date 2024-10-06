<?php

namespace App\Http\Services;

use App\Http\Requests\CategoryFilterRequest;
use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{
    public function index(CategoryFilterRequest $request)
    {
        return Category::query()
            ->when($request->with_products, function ($query) {
                return $query->with('products');
            })
            ->paginate(10);
    }
}
