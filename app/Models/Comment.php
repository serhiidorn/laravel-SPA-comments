<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

/**
 * @property int $id
 * @property int|null $parent_id
 * @property string $text
 * @property string $username
 * @property string $email
 * @property string $homepage
 * @property string|null $image
 * @property string|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $replies
 * @property-read Comment|null $parent
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'text',
        'username',
        'email',
        'homepage',
        'image',
        'file',
    ];

    protected $casts = [
        'text' => PurifyHtmlOnGet::class,
    ];

    protected $with = ['replies'];

    public function replies(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id')->latest();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }
}
