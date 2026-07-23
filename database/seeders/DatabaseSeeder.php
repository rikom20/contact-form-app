<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // まずカテゴリを作成
        $this->call(CategorySeeder::class);

        // 次に、作成したカテゴリを元にお問い合わせデータを35件作成
        Contact::factory()->count(35)->create();
    }
}