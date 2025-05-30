<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category 1 - Điện thoại (4 sản phẩm)
        DB::table('products')->insert([
            [
                'name' => 'iPhone 16 Pro Max',
                'image' => 'iphone.jpg',
                'price' => 35000000,
                'quantity' => 15,
                'description' => 'iPhone 16 Pro Max với chip A18 Pro, camera 48MP, màn hình 6.9 inch Super Retina XDR',
                'category_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'image' => 'iphone.jpg',
                'price' => 30000000,
                'quantity' => 12,
                'description' => 'Galaxy S24 Ultra với S Pen tích hợp, camera 200MP, màn hình Dynamic AMOLED 6.8 inch',
                'category_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Xiaomi 14 Ultra',
                'image' => 'iphone.jpg',
                'price' => 25000000,
                'quantity' => 8,
                'description' => 'Xiaomi 14 Ultra với Snapdragon 8 Gen 3, camera Leica 50MP, sạc nhanh 90W',
                'category_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'iPhone 15',
                'image' => 'iphone.jpg',
                'price' => 22000000,
                'quantity' => 20,
                'description' => 'iPhone 15 với chip A16 Bionic, camera 48MP, cổng USB-C',
                'category_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Category 2 - Laptop (4 sản phẩm)
        DB::table('products')->insert([
            [
                'name' => 'MacBook Pro M3 16 inch',
                'image' => 'laptop.jpg',
                'price' => 65000000,
                'quantity' => 5,
                'description' => 'MacBook Pro M3 16 inch với chip M3 Pro, RAM 18GB, SSD 512GB, màn hình Liquid Retina XDR',
                'category_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ASUS ROG Strix G16',
                'image' => 'laptop.jpg',
                'price' => 45000000,
                'quantity' => 7,
                'description' => 'Intel Core i9-13980HX, RTX 4070, RAM 32GB DDR5, SSD 1TB, màn hình 16 inch 165Hz',
                'category_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell XPS 13 Plus',
                'image' => 'laptop.jpg',
                'price' => 38000000,
                'quantity' => 6,
                'description' => 'Intel Core i7-1360P, RAM 16GB LPDDR5, SSD 512GB, màn hình 13.4 inch 3.5K OLED',
                'category_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lap top Acer Nitro 5',
                'image' => 'laptop.jpg',
                'price' => 1000000,
                'quantity' => 5,
                'description' => 'CPU: 6th Gen Intel® Core™ i7 6820HQ Processor 2.7GHz (up to 3.6GHz) 8Mb Cache
                                        RAM: 16GB DDR4 SDRAM 2400MHz
                                        Ổ cứng: SSD 1TB
                                        Màn hình: Anti-Glare 17.3 inch FHD (1920x1080)
                                        Card đồ họa: Nvidia Quadro M1200 (4GB 128bit GDDR5)
                                        Bảo hành: 1 tháng',
                'category_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Category 3 - Máy ảnh (4 sản phẩm)
        DB::table('products')->insert([
            [
                'name' => 'Sony Alpha A7R V',
                'image' => 'mayanh.jpg',
                'price' => 95000000,
                'quantity' => 3,
                'description' => 'Cảm biến Full-frame 61MP, xử lý BIONZ XR, quay video 8K, chống rung 5 trục',
                'category_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nikon Z9',
                'image' => 'mayanh.jpg',
                'price' => 135000000,
                'quantity' => 2,
                'description' => 'Cảm biến 45.7MP, quay video 8K/30p, tốc độ chụp 20fps, viewfinder 3.69M-dot',
                'category_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fujifilm X-T5',
                'image' => 'mayanh.jpg',
                'price' => 45000000,
                'quantity' => 6,
                'description' => 'Cảm biến X-Trans CMOS 5 HR 40.2MP, processor X-Processor 5, chống rung IBIS',
                'category_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Máy ảnh Canon EOS RP Kit RF24-105mm F4-7.1 IS STM',
                'image' => 'mayanh.jpg',
                'price' => 10999999,
                'quantity' => 10,
                'description' => 'Cảm biến	CMOS full-frame 26.2 megapixels
                                    Bộ xử lý hình ảnh	DIGIC 8
                                    - 4.779 vị trí lấy nét chọn lọc
                                    Màn hình LCD 3.0inch cảm ứng
                                    Tốc độ màn trập	30 1/4000 giây
                                    Tốc độ chụp	5 ảnh/ giây',
                'category_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Category 4 - Tai nghe (4 sản phẩm)
        DB::table('products')->insert([
            [
                'name' => 'Sony WH-1000XM5',
                'image' => 'tainghe.jpg',
                'price' => 8500000,
                'quantity' => 15,
                'description' => 'Tai nghe chống ồn cao cấp, driver 30mm, pin 30 giờ, sạc nhanh 3 phút dùng 3 giờ',
                'category_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AirPods Pro 2',
                'image' => 'tainghe.jpg',
                'price' => 6500000,
                'quantity' => 20,
                'description' => 'Chip H2, chống ồn thích ứng, âm thanh không gian, chống nước IPX4',
                'category_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bose QuietComfort 45',
                'image' => 'tainghe.jpg',
                'price' => 7200000,
                'quantity' => 10,
                'description' => 'Chống ồn hàng đầu, pin 24 giờ, kết nối Bluetooth 5.1, thiết kế thoải mái',
                'category_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tai nghe Broadcast Headset Sennheiser',
                'image' => 'tainghe.jpg',
                'price' => 5000000,
                'quantity' => 10,
                'description' => 'Nhẹ nhàng với đệm mềm mại để mang lại sự thoải mái tuyệt vời khi đeo
                                        Microphone cung cấp truyền âm thanh chất lượng phát sóng
                                        ActiveGard (có công tắc bật/tắt) để bảo vệ thính giác
                                        Tai nghe phát sóng chuyên nghiệp: micro động (dynamic)',
                'category_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Category 5 - Màn hình (4 sản phẩm)
        DB::table('products')->insert([
            [
                'name' => 'LG UltraGear 27GP950',
                'image' => 'manhinhmaytinh.jpg',
                'price' => 18000000,
                'quantity' => 8,
                'description' => 'Màn hình gaming 27 inch 4K UHD, Nano IPS, 144Hz, HDR600, G-SYNC Compatible',
                'category_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Odyssey G7 32 inch',
                'image' => 'manhinhmaytinh.jpg',
                'price' => 15000000,
                'quantity' => 6,
                'description' => 'Màn hình cong 1000R, QLED 32 inch, 240Hz, 1ms, HDR600, FreeSync Premium Pro',
                'category_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell UltraSharp U2723QE',
                'image' => 'manhinhmaytinh.jpg',
                'price' => 12000000,
                'quantity' => 10,
                'description' => 'Màn hình 27 inch 4K IPS Black, USB-C 90W, KVM switch, 95% DCI-P3',
                'category_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Màn hình Gaming ASUS ROG Swift OLED PG34WCDM',
                'image' => 'manhinhmaytinh.jpg',
                'price' => 20000000,
                'quantity' => 10,
                'description' => 'Chất lượng hình ảnh vượt trội với màn hình OLED 34 inch, độ phân giải 3440x1440, mang đến màu sắc sống động và độ tương phản ấn tượng.
                                    Tốc độ vượt bậc với tần số quét 240Hz và thời gian phản hồi 0.03ms, đảm bảo trải nghiệm chơi game mượt mà, không giật lag.
                                    Hỗ trợ công nghệ G-SYNC giúp loại bỏ hiện tượng xé hình, mang lại hình ảnh liền mạch trong các tựa game tốc độ cao.',
                'category_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Category 6 - Chuột máy tính (4 sản phẩm)
        DB::table('products')->insert([
            [
                'name' => 'Logitech MX Master 3S',
                'image' => 'chuotmaytinh.jpg',
                'price' => 2500000,
                'quantity' => 15,
                'description' => 'Chuột không dây cao cấp, sensor 8000 DPI, pin 70 ngày, kết nối 3 thiết bị',
                'category_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Razer DeathAdder V3 Pro',
                'image' => 'chuotmaytinh.jpg',
                'price' => 3500000,
                'quantity' => 12,
                'description' => 'Chuột gaming không dây, sensor Focus Pro 30K, switch quang học Gen-3, pin 90 giờ',
                'category_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SteelSeries Rival 650',
                'image' => 'chuotmaytinh.jpg',
                'price' => 2800000,
                'quantity' => 10,
                'description' => 'Chuột gaming có trọng lượng điều chỉnh, sensor TrueMove3+ 12000 CPI, RGB 256 màu',
                'category_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chuột không dây Logitech',
                'image' => 'chuotmaytinh.jpg',
                'price' => 500000,
                'quantity' => 10,
                'description' => 'Mới, đầy đủ phụ kiện từ nhà sản xuất',
                'category_id' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Category 7 - RAM (4 sản phẩm)
        DB::table('products')->insert([
            [
                'name' => 'Corsair Vengeance LPX 32GB DDR4-3200',
                'image' => 'ram.jpg',
                'price' => 3500000,
                'quantity' => 20,
                'description' => 'Bộ kit 2x16GB DDR4-3200MHz, tản nhiệt nhôm, hỗ trợ XMP 2.0, timing C16',
                'category_id' => '7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'G.Skill Trident Z5 RGB 32GB DDR5-5600',
                'image' => 'ram.jpg',
                'price' => 6500000,
                'quantity' => 15,
                'description' => 'DDR5-5600MHz CL36, RGB tùy chỉnh, tản nhiệt nhôm cao cấp, Intel XMP 3.0',
                'category_id' => '7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kingston Fury Beast 16GB DDR4-3200',
                'image' => 'ram.jpg',
                'price' => 1800000,
                'quantity' => 25,
                'description' => 'DDR4-3200MHz CL16, tản nhiệt thấp profile, Intel XMP ready, bảo hành trọn đời',
                'category_id' => '7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'RAM DDR4 8GB',
                'image' => 'ram.jpg',
                'price' => 1000000,
                'quantity' => 8,
                'description' => 'Bộ phận quan trọng nhất trong laptop, bởi nó không chỉ là nơi lưu trữ dữ liệu mà còn giúp máy tính xách tay hoạt động với hiệu suất, hiệu năng tốt nhất',
                'category_id' => '7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}