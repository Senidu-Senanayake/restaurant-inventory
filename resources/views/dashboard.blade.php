@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Total Products</h2>
        <p class="text-3xl font-bold">{{ $productCount }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Stock items (units)</h2>
        <p class="text-3xl font-bold">{{ $totalStockUnits }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Low stock (&lt; {{ $lowStockThreshold }} units)</h2>
        <p class="text-3xl font-bold text-red-500">{{ $lowStockCount }}</p>
    </div>

</div>

@endsection
