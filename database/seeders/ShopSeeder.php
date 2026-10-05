<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Elektronik' => [
                ['Headphone Bluetooth ANC X5', 459000],
                ['Speaker Portable Mini 20W', 289000],
                ['Smartwatch FitPro 2', 749000],
                ['Power Bank 20000mAh Fast Charge', 245000],
                ['Webcam Full HD 1080p', 335000],
                ['Lampu Meja LED Dimmer', 129000],
            ],
            'Fashion Pria' => [
                ['Kemeja Flanel Slim Fit', 189000],
                ['Kaos Polos Cotton Combed 30s', 65000],
                ['Celana Chino Regular', 219000],
                ['Jaket Bomber Water Resistant', 329000],
                ['Sneakers Kanvas Classic', 275000],
                ['Topi Baseball Washed', 55000],
            ],
            'Fashion Wanita' => [
                ['Blouse Linen Lengan Panjang', 175000],
                ['Rok Plisket Midi', 149000],
                ['Hijab Voal Premium', 59000],
                ['Tas Selempang Kulit Sintetis', 225000],
                ['Cardigan Rajut Oversize', 199000],
            ],
            'Perlengkapan Rumah' => [
                ['Rak Sepatu Susun 4 Tingkat', 159000],
                ['Set Pisau Dapur Stainless 5 Pcs', 215000],
                ['Rice Cooker 1.8L', 399000],
                ['Sprei Katun Queen Size', 249000],
                ['Dispenser Sabun Otomatis', 119000],
                ['Tempat Penyimpanan Lipat 3 Pcs', 99000],
            ],
            'Buku & Alat Tulis' => [
                ['Buku Catatan Hardcover A5', 45000],
                ['Pulpen Gel Set 12 Warna', 39000],
                ['Buku Dasar-Dasar Pemrograman Web', 98000],
                ['Planner Mingguan 2027', 69000],
                ['Highlighter Pastel 6 Pcs', 42000],
            ],
            'Olahraga' => [
                ['Matras Yoga Anti Slip 8mm', 129000],
                ['Dumbbell Adjustable 10kg', 285000],
                ['Sepatu Lari Ringan Aero', 389000],
                ['Botol Minum Tumbler 1L', 79000],
                ['Raket Badminton Carbon Set', 245000],
                ['Skipping Rope Speed', 45000],
            ],
            'Kecantikan' => [
                ['Facial Wash Gentle 100ml', 49000],
                ['Sunscreen SPF 50 PA++++', 85000],
                ['Serum Vitamin C 20ml', 115000],
                ['Lip Balm Natural 4g', 29000],
                ['Masker Wajah Sheet 10 Pcs', 65000],
            ],
            'Makanan & Minuman' => [
                ['Kopi Arabika Gayo 250g', 85000],
                ['Teh Hijau Premium 100g', 49000],
                ['Madu Hutan Murni 500ml', 125000],
                ['Keripik Singkong Pedas 200g', 25000],
                ['Granola Oat Madu 400g', 69000],
                ['Sambal Roa Botol 150g', 38000],
            ],
            'Gaming' => [
                ['Mouse Gaming RGB 7200 DPI', 175000],
                ['Keyboard Mechanical TKL Blue Switch', 449000],
                ['Mousepad Extended XL', 89000],
                ['Headset Gaming 7.1', 325000],
                ['Controller Gamepad Wireless', 285000],
            ],
            'Aksesoris HP' => [
                ['Casing Silikon Anti Crack', 49000],
                ['Tempered Glass Anti Gores', 35000],
                ['Kabel USB-C Fast Charge 1m', 59000],
                ['Charger 33W GaN', 149000],
                ['Holder HP Mobil Magnetik', 69000],
                ['Earphone Kabel Mic', 39000],
            ],
        ];

        foreach ($data as $categoryName => $items) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => "Koleksi {$categoryName} pilihan.",
            ]);

            foreach ($items as [$name, $price]) {
                Product::factory()->for($category)->create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'price' => $price,
                ]);
            }
        }
    }
}