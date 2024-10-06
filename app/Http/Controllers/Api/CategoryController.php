<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFilterRequest;
use App\Http\Resources\CategoryResource;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryServiceInterface $service
    ) {}

    public function index(CategoryFilterRequest $request)
    {
        return $this->sendSuccess(CategoryResource::collection($this->service->index($request)));
    }
}
