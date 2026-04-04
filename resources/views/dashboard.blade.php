@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Total Products</h2>
        <p class="text-3xl font-bold">0</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Stock Items</h2>
        <p class="text-3xl font-bold">0</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-gray-500">Low Stock</h2>
        <p class="text-3xl font-bold text-red-500">0</p>
    </div>

</div>

@endsection
