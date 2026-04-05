@extends('layouts.app')

@section('title', 'Stock')

@section('content')

@if (session('status'))
    <div class="mb-4 rounded bg-green-100 px-4 py-2 text-green-800">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded bg-red-100 px-4 py-2 text-red-700">
        {{ $errors->first() }}
    </div>
@endif

<div class="mb-4 flex justify-between">
    <h1 class="text-2xl font-bold">Stock</h1>
    <a href="{{ route('products.index') }}" class="rounded bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300">
        View products
    </a>
</div>

<table class="w-full table-fixed border-collapse overflow-hidden rounded bg-white text-left shadow">
    <colgroup>
        <col class="w-24 sm:w-28" />
        <col />
        <col class="w-28 sm:w-32" />
        <col class="w-44 sm:w-52" />
        <col class="w-44 sm:w-52" />
    </colgroup>
    <thead>
        <tr class="border-b border-gray-300 bg-gray-200 text-sm font-semibold text-gray-800">
            <th class="px-4 py-4 align-middle">Image</th>
            <th class="px-4 py-4 align-middle">Name</th>
            <th class="px-4 py-4 align-middle">Available</th>
            <th class="px-4 py-4 align-middle">Add stock</th>
            <th class="px-4 py-4 align-middle">Remove stock</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
            <tr class="border-b border-gray-200 bg-white">
                <td class="px-4 py-6 align-middle">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" width="48" height="48" class="h-12 w-12 rounded object-cover" alt="">
                    @else
                        <span class="inline-block h-12 w-12 rounded bg-gray-100" aria-hidden="true"></span>
                    @endif
                </td>
                <td class="px-4 py-6 align-middle font-medium text-gray-900">{{ $product->name }}</td>
                <td class="px-4 py-6 align-middle tabular-nums text-gray-800">{{ $product->quantity }}</td>
                <td class="px-4 py-6 align-middle">
                    <form action="{{ route('stock.add') }}" method="POST" class="flex flex-wrap items-center gap-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="999999" required
                               class="w-20 rounded border border-gray-300 px-2 py-1 text-sm">
                        <button type="submit" class="rounded bg-green-600 px-3 py-1 text-sm text-white hover:bg-green-700">
                            Add
                        </button>
                    </form>
                </td>
                <td class="px-4 py-6 align-middle">
                    <form action="{{ route('stock.remove') }}" method="POST" class="flex flex-wrap items-center gap-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="999999" required
                               class="w-20 rounded border border-gray-300 px-2 py-1 text-sm"
                               @disabled($product->quantity === 0)>
                        <button type="submit"
                                class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700 disabled:cursor-not-allowed disabled:opacity-50"
                                @disabled($product->quantity === 0)>
                            Remove
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                    No products yet.
                    <a href="{{ route('products.create') }}" class="text-blue-600 hover:underline">Create a product</a>
                    to manage stock.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
