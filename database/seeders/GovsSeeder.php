<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = "
        INSERT INTO `governments` (`id`, `gov`) VALUES
(1, 'القاهرة'),
(2, 'الجيزة'),
(3, 'أسوان'),
(4, 'أسيوط'),
(5, 'الأقصر'),
(6, 'البحر الأحمر'),
(7, 'البحيرة'),
(8, 'بني سويف'),
(9, 'بورسعيد'),
(10, 'جنوب سيناء'),
(11, 'الإسماعيلية'),
(12, 'الدقهلية'),
(13, 'دمياط'),
(14, 'سوهاج'),
(15, 'السويس'),
(16, 'الشرقية'),
(17, 'شمال سيناء'),
(18, 'الغربية'),
(19, 'الفيوم'),
(20, 'الإسكندرية'),
(21, 'القليوبية'),
(22, 'قنا'),
(23, 'كفر الشيخ'),
(24, 'مطروح'),
(25, 'المنوفية'),
(26, 'المنيا'),
(27, 'الوادي الجديد');
        ";
        DB::statement($sql);
    }
}
