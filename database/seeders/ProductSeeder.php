<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $products = [
            // Kamera ürünleri
            [
                'name' => 'Hikvision 2MP IP Kamera',
                'category' => 'kamera',
                'description' => 'Gece görüşlü, hareket algılamalı IP güvenlik kamerası',
                'price' => 1500.00,
                'stock' => 25,
                'features' => [
                    '2MP çözünürlük',
                    'Gece görüş 30m',
                    'PoE desteği',
                    'Hareket algılama',
                    'Mobil uygulama'
                ],
                'photo' => null,
            ],
            [
                'name' => 'Hikvision 4MP Dome Kamera',
                'category' => 'kamera',
                'description' => 'Yüksek çözünürlüklü iç mekan dome kamera',
                'price' => 2200.00,
                'stock' => 15,
                'features' => [
                    '4MP çözünürlük',
                    'Vandal proof',
                    'WDR teknolojisi',
                    'H.265+ codec'
                ],
                'photo' => null,
            ],
            [
                'name' => '8 Kanal NVR Kayıt Cihazı',
                'category' => 'kamera',
                'description' => '8 kameralı sistem için network video kaydedici',
                'price' => 3500.00,
                'stock' => 10,
                'features' => [
                    '8 kanal',
                    '4K çıkış',
                    '2TB HDD dahil',
                    'PoE switch dahil',
                    'Mobil erişim'
                ],
                'photo' => null,
            ],
            
            // İnternet ürünleri
            [
                'name' => 'TP-Link Archer AX50 Router',
                'category' => 'internet',
                'description' => 'WiFi 6 destekli yüksek hızlı router',
                'price' => 1800.00,
                'stock' => 20,
                'features' => [
                    'WiFi 6 (AX3000)',
                    'Dual-band',
                    'MU-MIMO',
                    'Gigabit portlar',
                    'Parental control'
                ],
                'photo' => null,
            ],
            [
                'name' => 'Ubiquiti UniFi AP AC Pro',
                'category' => 'internet',
                'description' => 'Profesyonel kablosuz erişim noktası',
                'price' => 2500.00,
                'stock' => 12,
                'features' => [
                    'Dual-band AC1750',
                    'PoE powered',
                    '200+ kullanıcı',
                    'Merkezi yönetim',
                    'Guest portal'
                ],
                'photo' => null,
            ],
            [
                'name' => 'Cat6 UTP Kablo (305m)',
                'category' => 'internet',
                'description' => 'Profesyonel ağ altyapı kablosu',
                'price' => 1200.00,
                'stock' => 30,
                'features' => [
                    'Cat6 standart',
                    '305 metre',
                    'Gigabit destekli',
                    'Solid bakır iletken'
                ],
                'photo' => null,
            ],
            
            // Çanak anten ürünleri
            [
                'name' => '80cm Çanak Anten',
                'category' => 'çanak anten',
                'description' => 'Standart uydu çanak anteni',
                'price' => 450.00,
                'stock' => 40,
                'features' => [
                    '80cm çap',
                    'Çelik konstrüksiyon',
                    'Hava koşullarına dayanıklı',
                    'Kolay montaj'
                ],
                'photo' => null,
            ],
            [
                'name' => 'Universal Single LNB',
                'category' => 'çanak anten',
                'description' => 'Tek çıkışlı LNB',
                'price' => 120.00,
                'stock' => 50,
                'features' => [
                    'Full HD destekli',
                    'Düşük gürültü',
                    'Hava koşullarına dayanıklı',
                    '1 yıl garanti'
                ],
                'photo' => null,
            ],
            [
                'name' => 'Quad LNB (4 Çıkışlı)',
                'category' => 'çanak anten',
                'description' => 'Dört çıkışlı LNB',
                'price' => 280.00,
                'stock' => 35,
                'features' => [
                    '4 bağımsız çıkış',
                    'Full HD destekli',
                    'Yüksek kalite',
                    'Kolay montaj'
                ],
                'photo' => null,
            ],
            [
                'name' => 'Uydu Sinyal Bulucu',
                'category' => 'çanak anten',
                'description' => 'Dijital uydu yön bulucu cihaz',
                'price' => 850.00,
                'stock' => 8,
                'features' => [
                    'Dijital gösterge',
                    'Sesli uyarı',
                    'DVB-S2 destekli',
                    'Profesyonel kullanım'
                ],
                'photo' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

