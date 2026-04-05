@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="mx-auto w-full max-w-3xl">
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data"
          class="rounded-lg border border-gray-200 bg-white p-6 shadow-md lg:p-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="mb-2 block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="Enter product name" required
                   class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('name')<span class="mt-1 block text-sm text-red-500">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="mb-2 block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" placeholder="Enter description" rows="5"
                      class="w-full resize-y rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
            @error('description')<span class="mt-1 block text-sm text-red-500">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4 grid gap-4 sm:grid-cols-2">
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" placeholder="0.00" required
                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('price')<span class="mt-1 block text-sm text-red-500">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700">Product Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full cursor-pointer rounded-md border border-gray-300 px-3 py-2 text-sm file:mr-3 file:rounded file:border-0 file:bg-gray-100 file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-gray-700 hover:file:bg-gray-200">
                @error('image')<span class="mt-1 block text-sm text-red-500">{{ $message }}</span>@enderror
                @if($product->image)
                    <div class="mt-3">
                        <p class="mb-1 text-xs text-gray-500">Current image</p>
                        <img src="{{ asset('storage/'.$product->image) }}" alt="" class="h-16 w-16 rounded object-cover ring-1 ring-gray-200">
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-wrap gap-2 pt-2">
            <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                Update Product
            </button>
            <a href="{{ route('products.index') }}" class="rounded-md bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection
