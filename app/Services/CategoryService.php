<?php

namespace App\Services;

use App\Http\Requests\CategoryFilterRequest;
use App\Models\Category;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    public function index(CategoryFilterRequest $request)
    {
        return Category::query()
            ->when($request->with_products, function ($query) {
                return $query->with('products');
            })
            ->get();
    }
}
