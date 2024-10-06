<?php

namespace App\Services\Interfaces;

use App\Http\Requests\CategoryFilterRequest;

interface CategoryServiceInterface
{
    public function index(CategoryFilterRequest $request);
}
