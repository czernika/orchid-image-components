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
            'name' => 'hashed-thumb',
            'original_name' => fake()->word,
            'mime' => 'image/jpg',
            'extension' => 'jpg',
            'path' => 'uploads/2023/',
            'disk' => 'public',
            'sort' => 0,
            'size' => 0,
            'hash' => 'hash',
        ];
    }
}
