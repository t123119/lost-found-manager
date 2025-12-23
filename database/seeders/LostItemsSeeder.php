<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LostItem;

class LostItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ja_JP'); // 日本語のデータを生成

        $categories = ['財布', '鍵', 'スマートフォン', '傘', 'カバン', '定期入れ', 'イヤホン'];
        $statuses = ['保管中', '返却済', '破棄済'];
        $places = ['北門付近', '3号館食堂', '図書館 2F', 'テニスコート', '情報工学棟 受付', 'バス停'];

        for ($i = 0; $i < 20; $i++) {
            LostItem::create([
                'name'         => $faker->word . '（' . $faker->colorName . '）',
                'category'     => $faker->randomElement($categories),
                'color'        => $faker->colorName,
                'found_place'  => $faker->randomElement($places),
                'found_date'   => $faker->dateTimeBetween('-1 month', 'now'), // 1ヶ月前から今までのランダムな日付
                'image_path'   => 'lost_items/dummy.jpg', // ダミー画像パス
                'description'  => $faker->realText(50), // 50文字程度のランダムな日本語
                'status'       => $faker->randomElement($statuses),
            ]);
        }
    }
}