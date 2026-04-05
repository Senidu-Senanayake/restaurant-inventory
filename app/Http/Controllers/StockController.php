<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::query()->orderBy('name')->get();

        return view('stock.index', compact('products'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:999999'],
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::query()->lockForUpdate()->findOrFail($validated['product_id']);
            $product->increment('quantity', $validated['quantity']);
        });

        return redirect()->route('stock.index')->with('status', 'Stock added.');
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:999999'],
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::query()->lockForUpdate()->findOrFail($validated['product_id']);
            if ($product->quantity < $validated['quantity']) {
                throw ValidationException::withMessages([
                    'quantity' => 'Not enough stock to remove this amount.',
                ]);
            }
            $product->decrement('quantity', $validated['quantity']);
        });

        return redirect()->route('stock.index')->with('status', 'Stock removed.');
    }
}
