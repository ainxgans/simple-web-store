<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        try {
            $data = Cart::where('user_id', auth()->user()->id)->get();
            return view('user.carts.index', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to get cart data');
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => auth()->user()->id,
                'product_id' => 'exists:products,id',
                'qty' => 'integer|min:1',
            ]);
            $validated['price'] = $validated['qty'] * Product::findOrFail($validated['product_id'])->price;
            $data = Cart::create($validated);
            return response()->json([
                'data' => $data,
                'message' => 'Added to cart'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to add to cart',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
