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
        //
        DB::table('products')->insert([
                [
                    'name' => 'Iphone 1616',
                    'image' => 'iphone.png',
                    'price' => 50000,
                    'quantity' => 10,
                    'description' => 'dsafdfafdsfs',
                    'category_id' => '1',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

         DB::table('products')->insert([
                [
                    'name' => 'Lap top acer nitro 55',
                    'image' => 'laptop.png',
                    'price' => 1000000,
                    'quantity' => 5,
                    'description' => ' CPU: 6th Gen Intel® Core™ i7 6820HQ Processor 2.7GHz (up to 3.6GHz) 8Mb Cache
                                        RAM: 16GB DDR4 SDRAM 2400MHz
                                        Ổ cứng: SSD 1TB
                                        Màn hình: Anti-Glare 17.3 inch FHD (1920x1080)
                                        Card đồ họa: Nvidia Quadro M1200 (4GB 128bit GDDR5)
                                        Tình trạng: Hàng Like New
                                        Bảo hành : 1 thángFF',
                    'category_id' => '2',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
             DB::table('products')->insert([
                [
                    'name' => 'Máy ảnh Canon EOS RP Kit RF24-105mm F4-7.1 IS STM',
                    'image' => 'mayanh.png',
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
             DB::table('products')->insert([
                [
                    'name' => 'Tai nghe Broadcast Headset Sennheiser',
                    'image' => 'tainghe.png',
                    'price' => 50000,
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
             DB::table('products')->insert([
                [
                    'name' => 'Màn hình Gaming ASUS ROG Swift OLED PG34WCDM',
                    'image' => 'manhinhmaytinh.png',
                    'price' => 2000000,
                    'quantity' => 10,
                    'description' => 'Chất lượng hình ảnh vượt trội với màn hình OLED 34 inch, độ phân giải 3440x1440, mang đến màu sắc sống động và độ tương phản ấn tượng.
                                    Tốc độ vượt bậc với tần số quét 240Hz và thời gian phản hồi 0.03ms, đảm bảo trải nghiệm chơi game mượt mà, không giật lag.
                                    Hỗ trợ công nghệ G-SYNC giúp loại bỏ hiện tượng xé hình, mang lại hình ảnh liền mạch trong các tựa game tốc độ cao.',
                    'category_id' => '5',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
             DB::table('products')->insert([
                [
                    'name' => 'Chuột không dây Logitech',
                    'image' => 'chuot.jpg',
                    'price' => 50000,
                    'quantity' => 10,
                    'description' => 'Mới, đầy đủ phụ kiện từ nhà sản xuấ',
                    'category_id' => '6',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
             DB::table('products')->insert([
                [
                    'name' => 'Ram',
                    'image' => 'ram.jpg',
                    'price' => 100000,
                    'quantity' => 8,
                    'description' => 'bộ phận quan trọng nhất trong laptop, bởi nó không chỉ là nơi lưu trữ dữ liệu mà còn giúp máy tính xách tay hoạt động với hiệu suất, hiệu năng tốt nhất',
                    'category_id' => '7',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
    }
}
