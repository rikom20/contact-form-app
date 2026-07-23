<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    public function definition()
    {
        return [
            // 登録したcategoriesのidからランダムで紐付け
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->numberBetween(1, 3), // 1〜3のランダム
            'email' => $this->faker->safeEmail(),
            // 3つの入力（例: 080-1234-5678）を合体させた数字のみの文字列を想定
            'tel' => $this->faker->numerify('090-####-####'),
            'address' => $this->faker->address(),
            'building' => $this->faker->secondaryAddress(),
            'detail' => $this->faker->realText(100), // 120文字以内のテキスト
        ];
    }
}