<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Order;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_order(): void
    {
        // สร้างสินค้าในฐานข้อมูล
        $product = Product::create([
            'name' => 'Product ABC',
            'description' => 'Description for Product ABC',
            'image' => 'ABC.jpg',
            'price' => 100.00,
        ]);

        // เรียก API สร้างคำสั่งซื้อ
        $response = $this->json('POST', '/api/orders', [
            'email' => 'test@test.com',
            'phone' => '1234567890',
            'shipping_address' => 'Address A',
            'billing_address' => 'Billing AddressA',
            'product_id' => $product->id,
            'summary_price' => 100.00,
        ]);

        // ตรวจสอบสถานะการตอบกลับ
        $response->assertStatus(201);

        // ตรวจสอบว่าข้อมูล Order ถูกบันทึกในฐานข้อมูลหรือไม่
        $this->assertDatabaseHas('orders', [
            'email' => 'test@test.com',
            'phone' => '1234567890',
            'shipping_address' => 'Address A',
            'billing_address' => 'Billing AddressA',
            'product_id' => $product->id,
            'summary_price' => 100.00,
        ]);
    }
}
