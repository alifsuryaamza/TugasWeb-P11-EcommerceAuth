<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $komentar = [
            'Barang sesuai deskripsi, pengiriman cepat.',
            'Kualitas bagus untuk harganya.',
            'Packing rapi, recommended.',
            'Lumayan, sesuai ekspektasi.',
        ];

        User::where('role', 'user')->each(function ($user) use ($products, $komentar) {
            $address = $user->addresses()->first();

            foreach (range(1, rand(1, 3)) as $i) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'address_id' => $address?->id,
                    'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                    'status' => fake()->randomElement(['pending', 'paid', 'shipped', 'completed']),
                    'total' => 0,
                ]);

                $total = 0;
                foreach ($products->random(rand(1, 4)) as $product) {
                    $qty = rand(1, 3);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price' => $product->price,
                    ]);
                    $total += $qty * $product->price;
                }

                $order->update(['total' => $total]);
            }

            foreach ($products->random(3) as $product) {
                Review::firstOrCreate(
                    ['user_id' => $user->id, 'product_id' => $product->id],
                    ['rating' => rand(3, 5), 'comment' => fake()->randomElement($komentar)]
                );
            }
        });
    }
}