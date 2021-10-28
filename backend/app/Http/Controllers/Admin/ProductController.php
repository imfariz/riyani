<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index() 
    {
        $items = Product::all();
        return view('pages.admin.product.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('pages.admin.product.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['image'] = $request->file('image')->store(
            'assets/product', 'public'
        );

        Product::create($data);
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $item = Product::findOrFail($id);
        
        return view('pages.admin.product.edit', [
            'item' => $item
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id);

        if(Storage::exists($item->image)) {
            Storage::delete($item->image);
        }
        
        $data['image'] = $request->file('image')->store('public');
        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $item = Product::findOrFail($id);

        if(Storage::exists($item->image)) {
            Storage::delete($item->image);
        }
        $item->delete();
        
        return redirect()->route('product.index');
    }
}
