<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountCheckoutAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_customer_can_register_and_login(): void
    {
        $this->post(route('register.store'), [
            'name' => 'Mona Ali',
            'email' => 'mona@example.com',
            'phone' => '01000000000',
            'address' => 'Cairo, Egypt',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticatedAs(User::where('email', 'mona@example.com')->first());
        $this->post(route('logout'))->assertRedirect(route('login'));
        $this->post(route('login.store'), ['email' => 'mona@example.com', 'password' => 'Password123'])->assertRedirect(route('home'));
    }

    public function test_an_approved_admin_email_registers_as_admin(): void
    {
        config(['auth.admin_emails' => ['admin@example.com']]);

        $this->post(route('register.store'), [
            'name' => 'Admin User',
            'email' => 'ADMIN@example.com',
            'phone' => '01000000000',
            'address' => 'Cairo, Egypt',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ])->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
    }

    public function test_authenticated_customer_can_checkout_cart(): void
    {
        $user = User::factory()->create(['role' => 'customer']);
        $product = Product::factory()->create(['price' => 100, 'stock' => 5]);
        $cart = Cart::create(['session_id' => 'checkout-session']);
        $cart->products()->attach($product, ['quantity' => 2]);

        $this->actingAs($user)->withSession(['cart_id' => $cart->id])
            ->post(route('checkout.store'), [
                'shipping_name' => $user->name,
                'shipping_phone' => '01000000000',
                'shipping_address' => 'Cairo, Egypt',
            ])->assertRedirect();

        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'total' => 200]);
        $this->assertDatabaseHas('order_items', ['product_id' => $product->id, 'quantity' => 2]);
    }

    public function test_a_customer_can_view_and_update_their_profile(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $this->actingAs($user)->get(route('profile'))->assertOk();
        $this->actingAs($user)->patch(route('profile.update'), [
            'name' => 'Updated Name',
            'email' => $user->email,
            'phone' => '01001112223',
            'address' => 'New address',
        ])->assertRedirect();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'phone' => '01001112223',
            'address' => 'New address',
        ]);
    }

    public function test_only_admins_can_access_dashboard(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($customer)->get(route('admin.dashboard'))->assertForbidden();
        $this->actingAs($admin)->get(route('admin.dashboard'))->assertOk();
    }
}
