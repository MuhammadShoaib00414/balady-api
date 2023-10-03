<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Muncipilty;

class MunciplitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $muncipilties = [
        //  Munciplity ID   Munciplity name
        ['id' => '002', 'name' => 'أمانة العاصمة المقدسة'],
        ['id' => '003', 'name' => 'أمانة منطقة المدينة المنورة'],
        ['id' => '004', 'name' => 'أمانة منطقة الرياض'],
        ['id' => '005', 'name' => 'أمانة محافظة جدة'],
        ['id' => '006', 'name' => 'أمانة المنطقة الشرقية'],
        ['id' => '007', 'name' => 'أمانة منطقة عسير'],
        ['id' => '008', 'name' => 'أمانة منطقة القصيم'],
        ['id' => '009', 'name' => 'أمانة منطقة جازان'],
        ['id' => '010', 'name' => 'أمانة منطقة الجوف'],
        ['id' => '011', 'name' => 'أمانة منطقة تبوك'],
        ['id' => '012', 'name' => 'أمانة منطقة حائل'],
        ['id' => '013', 'name' => 'أمانة منطقة الحدود الشمالية'],
        ['id' => '014', 'name' => 'أمانة منطقة الباحة'],
        ['id' => '015', 'name' => 'أمانة منطقة نجران'],
        ['id' => '016', 'name' => 'أمانة منطقة الطائف'],
        ['id' => '017', 'name' => 'أمانة منطقة الاحساء'],
        ['id' => '018', 'name' => 'أمانة منطقة حفر الباطن'],
        ];



        foreach ($muncipilties as $key => $value) {

            Muncipilty::create($value);

        }
    }
}
