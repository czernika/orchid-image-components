<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\Models\Attachment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Orchid\Attachment\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition(): array
    {
        return [
            'name' => 'hashed-thumb.jpg',
            'original_name' => fake()->word,
            'mime' => 'image/jpg',
            'extension' => 'jpg',
            'path' => 'uploads/2023/',
        ];
    }
}
