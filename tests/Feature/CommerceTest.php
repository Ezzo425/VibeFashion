<?php

namespace Tests\Feature;

use App\Mail\WelcomeSubscriber;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CommerceTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_can_be_added_updated_and_removed_from_the_cart(): void
    {
        $product = Product::factory()->create(['name' => 'Test Frames', 'price' => 100, 'stock' => 10]);

        $this->withHeaders(['Accept' => 'application/json'])
            ->post(route('cart.store', $product))
            ->assertOk()
            ->assertJsonPath('item_count', 1);
        $this->assertDatabaseHas('cart_items', ['product_id' => $product->id, 'quantity' => 1]);

        $this->withHeaders(['Accept' => 'application/json'])
            ->patch(route('cart.update', $product), ['quantity' => 3])
            ->assertOk()
            ->assertJsonPath('line_total', '300.00');
        $this->assertDatabaseHas('cart_items', ['product_id' => $product->id, 'quantity' => 3]);

        $this->withHeaders(['Accept' => 'application/json'])
            ->delete(route('cart.destroy', $product))
            ->assertOk()
            ->assertJsonPath('item_count', 0);
        $this->assertDatabaseMissing('cart_items', ['product_id' => $product->id]);
    }

    public function test_products_can_be_searched_and_subscribers_receive_a_welcome_email(): void
    {
        Mail::fake();
        Product::factory()->create(['name' => 'Orbit Hoops', 'category' => 'Earrings']);
        Product::factory()->create(['name' => 'Daybreak Frames', 'category' => 'Eyewear']);

        $this->get(route('search', ['q' => 'Hoops']))
            ->assertOk()
            ->assertSee('Orbit Hoops')
            ->assertDontSee('Daybreak Frames');

        $this->post(route('subscribe'), ['email' => 'buyer@example.com'])->assertRedirect();
        $this->assertDatabaseHas('subscribers', ['email' => 'buyer@example.com']);
        Mail::assertSent(WelcomeSubscriber::class, fn (WelcomeSubscriber $mail) => $mail->hasTo('buyer@example.com'));
    }
}
