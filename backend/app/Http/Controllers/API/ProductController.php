<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller 
{
    public function all(Request $request) 
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 9);
        $name = $request->input('name');
        $slug = $request->input('slug');
        $type = $request->input('type');

        if($id) 
            {
                $product = Product::find($id);
    
                if($product)
                    return ResponseFormatter::success($product, 'Data produk berhasil diambil');
                else
                    return responseFormatter::error(null, 'Data produk tidak ada', 404);
            }

        if($slug) 
            {
                $product = Product::where('slug', $slug)->first();

                if($product)
                    return ResponseFormatter::success($product, 'Data produk berhasil diambil');
                else
                    return responseFormatter::error(null, 'Data produk tidak ada', 404);
            }
        
        $product = Product::paginate($limit);

        if($name)
            $product->where('name', 'like', '%' . $name . '%');

        if($type)
            $product->where('type', 'like', '%' . $type . '%');

        return ResponseFormatter::success(
            $product,
            'Data list berhasil diambil'
        );
    }

}