<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = env('ADMIN_SEED_EMAIL');
        $adminPassword = env('ADMIN_SEED_PASSWORD');

        if ($adminEmail && $adminPassword) {
            User::updateOrCreate(
                ['email' => strtolower($adminEmail)],
                ['name' => 'VibeFashion Admin', 'password' => $adminPassword, 'role' => 'admin']
            );
        }

        Product::query()->delete();
        Category::query()->delete();

        $categoryRecords = [
            ['name' => 'Eyewear', 'slug' => 'eyewear', 'description' => 'Frames and sunglasses for every point of view.', 'image_path' => 'assets/img/products/eyewear.jpg'],
            ['name' => 'Necklaces', 'slug' => 'necklaces', 'description' => 'Layered chains and quiet statement pieces.', 'image_path' => 'assets/img/products/necklaces.jpg'],
            ['name' => 'Rings', 'slug' => 'rings', 'description' => 'Stackable details made for daily wear.', 'image_path' => 'assets/img/products/rings.jpg'],
            ['name' => 'Bracelets', 'slug' => 'bracelets', 'description' => 'Refined links and sculptural cuffs.', 'image_path' => 'assets/img/products/bracelets.jpg'],
            ['name' => 'Earrings', 'slug' => 'earrings', 'description' => 'Polished shapes for every occasion.', 'image_path' => 'assets/img/products/earrings.jpg'],
            ['name' => 'Jewelry', 'slug' => 'jewelry', 'description' => 'Considered pieces for meaningful occasions.', 'image_path' => 'assets/img/products/jewelry-display.jpg'],
            ['name' => 'Accessories', 'slug' => 'accessories', 'description' => 'Small details that keep your edit complete.', 'image_path' => 'assets/img/products/case.jpg'],
        ];

        $categories = collect($categoryRecords)->mapWithKeys(fn(array $category) => [$category['name'] => Category::create($category)]);

        $products = [
            ['Eyewear', 'Daybreak Frames', 'assets/img/products/eyewear.jpg', 85, 'Warm tortoiseshell frames with an easy everyday silhouette.', 18, true],
            ['Eyewear', 'Solaris Shades', 'assets/img/products/sunglasses.jpg', 95, 'Sun-ready lenses and a clean, confident profile.', 14, true],
            ['Necklaces', 'Layered Light Necklace', 'assets/img/products/necklaces.jpg', 70, 'A delicate layered chain that adds polish in seconds.', 22, true],
            ['Rings', 'Everyday Ring Stack', 'assets/img/products/rings.jpg', 55, 'Three stackable bands for a look that is all your own.', 30, false],
            ['Bracelets', 'Soft Link Bracelet', 'assets/img/products/bracelets.jpg', 60, 'A refined link bracelet with a comfortable low profile.', 20, false],
            ['Jewelry', 'Curated Gold Edit', 'assets/img/products/jewelry-display.jpg', 120, 'A considered mix of pieces for special occasions.', 9, false],
            ['Eyewear', 'Clear View Optical', 'assets/img/products/optical.jpg', 78, 'Lightweight clear frames with a modern, quiet finish.', 16, false],
            ['Necklaces', 'Pearl Line Pendant', 'assets/img/products/pendant.jpg', 88, 'A luminous pendant for understated daily layering.', 12, false],
            ['Earrings', 'Orbit Hoops', 'assets/img/products/earrings.jpg', 48, 'Polished hoops with a simple shape that goes everywhere.', 25, false],
            ['Earrings', 'Sunlit Studs', 'assets/img/products/studs.jpg', 42, 'Small polished studs for a clean everyday finish.', 28, false],
            ['Bracelets', 'Muse Cuff', 'assets/img/products/cuff.jpg', 72, 'A sculptural cuff that brings a little edge to basics.', 11, false],
            ['Rings', 'Signet Mini', 'assets/img/products/signet.jpg', 64, 'A compact signet ring with a timeless feel.', 19, false],
            ['Accessories', 'Satin Case', 'assets/img/products/case.jpg', 25, 'A protective soft case for your favorite frames.', 40, false],
            ['Accessories', 'Frame Strap', 'assets/img/products/strap.jpg', 18, 'A practical, polished strap to keep your frames close.', 35, false],
            ['Jewelry', 'Pearl Timepiece', 'assets/img/products/pearl-set.jpg', 110, 'A refined accessory that completes a dressed-up edit.', 8, false],
        ];

        foreach ($products as [$category, $name, $imagePath, $price, $description, $stock, $featured]) {
            Product::create([
                'category' => $category,
                'category_id' => $categories[$category]->id,
                'name' => $name,
                'image_path' => $imagePath,
                'price' => $price,
                'description' => $description,
                'stock' => $stock,
                'is_featured' => $featured,
            ]);
        }
    }
}
