<?php

namespace Workbench\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\Models\AttachmentWithPlaceholder;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Orchid\Attachment\Models\Attachment>
 */
class AttachmentWithPlaceholderFactory extends Factory
{
    protected $model = AttachmentWithPlaceholder::class;

    public function definition(): array
    {
        return [
            'name' => 'broken-thumb',
            'original_name' => fake()->word,
            'mime' => 'image/jpg',
            'extension' => 'jpg',
            'path' => 'uploads/2023/',
            'disk' => 'public',
        ];
    }
}
