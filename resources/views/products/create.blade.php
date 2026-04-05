@extends('layouts.app')

@section('title', 'Add Product')

@section('content')

<div class="max-w-2xl mx-auto">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
            <input type="text" name="name" placeholder="Enter product name" class="w-full px-3 py-2 border rounded" required>
            @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" placeholder="Enter description" class="w-full px-3 py-2 border rounded" rows="4"></textarea>
            @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
            <input type="number" step="0.01" name="price" placeholder="0.00" class="w-full px-3 py-2 border rounded" required>
            @error('price')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
            <input type="file" name="image" class="w-full px-3 py-2 border rounded" accept="image/*">
            @error('image')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Save Product
            </button>
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection
