@extends('layouts.app')

@section('title', 'Products')

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

<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Products</h1>

    <a href="{{ route('products.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded">
        + Add Product
    </a>
</div>

<table class="w-full table-fixed border-collapse overflow-hidden rounded bg-white text-left shadow">
    <colgroup>
        <col class="w-28 sm:w-32" />
        <col />
        <col class="w-28 sm:w-32" />
        <col class="w-36 sm:w-40" />
    </colgroup>
    <thead>
        <tr class="border-b border-gray-300 bg-gray-200 text-sm font-semibold text-gray-800">
            <th class="px-4 py-4 align-middle">Image</th>
            <th class="px-4 py-4 align-middle">Name</th>
            <th class="px-4 py-4 align-middle">Price</th>
            <th class="px-4 py-4 align-middle">Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($products as $product)
            <tr class="border-b border-gray-200 bg-white">
                <td class="px-4 py-6 align-middle">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" width="56" height="56" class="h-14 w-14 rounded object-cover" alt="{{ $product->name }}">
                    @else
                        <span class="inline-block h-14 w-14 rounded bg-gray-100" aria-hidden="true"></span>
                    @endif
                </td>

                <td class="px-4 py-6 align-middle font-medium text-gray-900">{{ $product->name }}</td>
                <td class="px-4 py-6 align-middle tabular-nums text-gray-800">{{ number_format($product->price, 2) }}</td>

                <td class="px-4 py-6 align-middle">
                    <a href="{{ route('products.edit', $product->id) }}"
                       class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('products.destroy', $product->id) }}"
                          method="POST" class="ms-3 inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                    No products yet. Click "+ Add Product" to create your first item.
                </td>
            </tr>
        @endforelse
    </tbody>

</table>

@endsection