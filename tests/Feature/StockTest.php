<?php

use App\Models\Product;
use App\Models\User;

test('stock page is displayed for authenticated user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('stock.index'));

    $response->assertOk();
});

test('authenticated user can add stock to a product', function () {
    $user = User::factory()->create();
    $product = Product::query()->create([
        'name' => 'Test Item',
        'description' => null,
        'price' => 9.99,
        'image' => null,
        'quantity' => 0,
    ]);

    $response = $this->actingAs($user)->post(route('stock.add'), [
        'product_id' => $product->id,
        'quantity' => 5,
    ]);

    $response->assertRedirect(route('stock.index'));
    $response->assertSessionHas('status');

    expect($product->fresh()->quantity)->toBe(5);
});

test('authenticated user can remove stock from a product', function () {
    $user = User::factory()->create();
    $product = Product::query()->create([
        'name' => 'Test Item',
        'description' => null,
        'price' => 9.99,
        'image' => null,
        'quantity' => 10,
    ]);

    $response = $this->actingAs($user)->post(route('stock.remove'), [
        'product_id' => $product->id,
        'quantity' => 3,
    ]);

    $response->assertRedirect(route('stock.index'));
    $response->assertSessionHas('status');

    expect($product->fresh()->quantity)->toBe(7);
});

test('remove stock fails when quantity exceeds on hand', function () {
    $user = User::factory()->create();
    $product = Product::query()->create([
        'name' => 'Test Item',
        'description' => null,
        'price' => 9.99,
        'image' => null,
        'quantity' => 2,
    ]);

    $response = $this->actingAs($user)->post(route('stock.remove'), [
        'product_id' => $product->id,
        'quantity' => 5,
    ]);

    $response->assertSessionHasErrors('quantity');
    expect($product->fresh()->quantity)->toBe(2);
});

test('guest cannot access stock routes', function () {
    $this->get(route('stock.index'))->assertRedirect(route('login'));
});
