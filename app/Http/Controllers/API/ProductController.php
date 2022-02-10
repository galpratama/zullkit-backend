<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $subtitle = $request->input('subtitle');
        $description = $request->input('description');
        $categories = $request->input('categories');

        if($id)
        {
            $product = Product::with(['category','galleries'])->find($id);

            if($product)
                return ResponseFormatter::success(
                    $product,
                    'Data produk berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
        }

        $product = Product::with(['category','galleries']);

        if($name)
            $product->where('name', 'like', '%' . $name . '%');

        if($subtitle)
            $product->where('tags', 'like', '%' . $subtitle . '%');

        if($description)
            $product->where('description', 'like', '%' . $description . '%');

        if($categories)
            $product->where('categories_id', $categories);

        return ResponseFormatter::success(
            $product->paginate($limit),
            'Data list produk berhasil diambil'
        );
    }
}
