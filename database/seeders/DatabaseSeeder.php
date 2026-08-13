<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ar_SA');

        // 1. حسابات أساسية (Admin & User)
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'name' => 'Test User',
                'email' => 'user@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'created_at' => now(), 'updated_at' => now(),
            ]
        ]);

        // إضافة 50 مستخدم عشوائي
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 2. إنشاء قائمة مدن
        $cities = ['القاهرة', 'الإسكندرية', 'الجيزة', 'شرم الشيخ', 'الغردقة', 'الأقصر', 'أسوان', 'دهب', 'مرسى علم', 'مطروح'];
        $cityIds = [];
        foreach ($cities as $cityName) {
            $cityIds[] = DB::table('cities')->insertGetId([
                'name' => $cityName,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // 3. خدمات الفندق (Amenities)
        $amenities = ['واي فاي مجاني', 'حمام سباحة', 'إفطار مجاني', 'تكييف هواء', 'إطلالة على البحر', 'صالة ألعاب رياضية', 'سبا', 'خدمة غرف 24/7', 'موقف سيارات'];
        $amenityIds = [];
        foreach ($amenities as $amenityName) {
            $amenityIds[] = DB::table('amenities')->insertGetId([
                'name' => $amenityName,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }

        // أنواع الغرف المتاحة (نص عادي في نسختنا)
        $roomTypes = ['Single', 'Double', 'Junior Suite', 'Royal Suite', 'Villa'];

        // 4. توليد 30 فندق مختلف
        $hotelPrefixes = ['فندق', 'منتجع', 'جراند فندق', 'بنسيون'];
        $hotelNames = ['الماسة', 'هيلتون', 'شيراتون', 'فورسيزونز', 'ريتز كارلتون', 'موفنبيك', 'فلسطين', 'شتايجنبرجر', 'ماريوت', 'سوفيتيل', 'تيوليب', 'رويال'];

        for ($h = 1; $h <= 30; $h++) {
            $hotelName = $faker->randomElement($hotelPrefixes) . ' ' . $faker->randomElement($hotelNames) . ' ' . $h;

            $hotelId = DB::table('hotels')->insertGetId([
                'city_id' => $faker->randomElement($cityIds),
                'name' => $hotelName,
                'description' => $faker->sentence(10),
                'address' => $faker->streetAddress(),
                'rating' => $faker->randomFloat(1, 3, 5),
                'created_at' => now(), 'updated_at' => now(),
            ]);

            // توليد من 10 إلى 20 غرفة لكل فندق
            $roomCount = rand(10, 20);
            $roomIds = [];
            for ($r = 1; $r <= $roomCount; $r++) {
                $roomIds[] = DB::table('rooms')->insertGetId([
                    'hotel_id' => $hotelId,
                    'type' => $faker->randomElement($roomTypes),
                    'price' => $faker->numberBetween(500, 10000),
                    'capacity' => $faker->numberBetween(1, 6),
                    'description' => $faker->sentence(8),
                    'is_available' => $faker->boolean(80), // 80% متاحة
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }

            // ربط الفندق بـ 3-5 خدمات عشوائية لكل غرفة (اختياري بسيط للتجربة)
            foreach ($roomIds as $roomId) {
                $randomAmenities = $faker->randomElements($amenityIds, rand(2, 4));
                foreach ($randomAmenities as $amenityId) {
                    DB::table('amenity_room')->insert([
                        'amenity_id' => $amenityId,
                        'room_id' => $roomId,
                        'created_at' => now(), 'updated_at' => now(),
                    ]);
                }
            }
        }

        $this->call(ReviewSeeder::class);
    }
}