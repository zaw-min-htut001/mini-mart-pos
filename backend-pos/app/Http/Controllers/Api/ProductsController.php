<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;

class ProductsController extends Controller
{
    //
    public function index()
    {
        try {
            $products =product::filter(request(['name', 'category_id', 'brand_id' , 'supplier_id']))
            ->orderBy('product_id' ,'DESC')
            ->get();
        return ResponseHelper::success(ProductResource::collection($products));

        } catch (Exception $e) {
            return ResponseHelper::fail($e->getMessage());
        }
    }

    //
    public function categories()
    {
        try {
            $categories = category::all();
            return ResponseHelper::success(CategoryResource::collection($categories));
        } catch (Exception $e) {
            return ResponseHelper::fail($e->getMessage());
        }

    }
}
