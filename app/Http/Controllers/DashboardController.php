<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'productCount' => Product::query()->count(),
        ]);
    }
}
