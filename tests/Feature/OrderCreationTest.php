<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;
use Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OrderCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_can_be_created_via_service()
    {
        Event::fake();

        // Setup
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create([
            'price' => 100
        ]);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'weight' => 0,
            'options' => [
                'product_size' => ['price' => 0],
                'product_options' => []
            ]
        ]);


        $address = \App\Models\Address::factory()->create([
            'user_id' => $user->id
        ]);

        $sessionData = [
            'address' => $address->id,
            'deliveryPrice' => 10,
            'discount' => 0,
            'coupon' => null
        ];

        // Execute
        $service = app(OrderService::class);
        $order = $service->createOrder($user, Cart::content(), $sessionData);

        // Assert
        $this->assertInstanceOf(Order::class, $order);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'user_id' => $user->id,
            'subtotal' => 100,
            'grand_total' => 110 // 100 + 10 delivery
        ]);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id
        ]);
    }
}
