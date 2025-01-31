<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        if (request()->has('search')) {
            $products = Product::where('name', 'like', '%' . request('search') . '%')->orderByDesc('created_at')->get();
        } else {
            $products = Product::orderByDesc('created_at')->get();
        }
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric',
                'stock' => 'required|numeric',
            ]);
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                if ($path) {
                    $validated['image'] = $path;
                } else {
                    throw new \Exception('Failed to upload image');
                }
            }
            Product::create($validated);
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        $cek = Excel::import(new ProductsImport(), $request->file('file'));
        return redirect()->route('products.index')->with('success', 'Products created successfully');
    }

    public function show($id)
    {
    }

    public function edit(Product $product)
    {

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
