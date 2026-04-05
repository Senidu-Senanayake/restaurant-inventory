@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow w-1/2">
	@csrf
	@method('PUT')

	<input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="Product Name" class="w-full mb-4 p-2 border rounded">

	<textarea name="description" placeholder="Description" class="w-full mb-4 p-2 border rounded">{{ old('description', $product->description) }}</textarea>

	<input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" placeholder="Price" class="w-full mb-4 p-2 border rounded">

	<input type="file" name="image" class="mb-4">

	<button class="bg-blue-500 text-white px-4 py-2 rounded">
		Update Product
	</button>
</form>

@endsection
