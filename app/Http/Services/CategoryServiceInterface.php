<?php

namespace App\Http\Services;

use App\Http\Requests\CategoryFilterRequest;

interface CategoryServiceInterface
{
    public function index(CategoryFilterRequest $request);
}
