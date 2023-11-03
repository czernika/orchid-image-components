<?php

declare(strict_types=1);

namespace Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Platform\Dashboard;

class Post extends Model
{
    use Attachable, HasFactory;

    protected $fillable = [
        'thumb_url',
        'thumb_id',
    ];

    public function thumb()
    {
        return $this->hasOne(Dashboard::model(Attachment::class), 'id', 'thumb_id');
    }
}
