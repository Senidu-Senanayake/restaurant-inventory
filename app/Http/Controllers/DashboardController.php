<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    private const LOW_STOCK_THRESHOLD = 10;

    public function index()
    {
        return view('dashboard', [
            'productCount' => Product::query()->count(),
            'totalStockUnits' => (int) Product::query()->sum('quantity'),
            'lowStockCount' => Product::query()->where('quantity', '<', self::LOW_STOCK_THRESHOLD)->count(),
            'lowStockThreshold' => self::LOW_STOCK_THRESHOLD,
        ]);
    }
}
