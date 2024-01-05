<?php

namespace App\Models;

use App\Library\Enum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Vite;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','article','thumb','picture', 'category_id', 'author_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getThumb(): string
    {
        $path = public_path($this->thumb);

        if($this->thumb && is_file($path) && file_exists($path)) {
            return asset($this->thumb);
        }

        return Vite::asset(Enum::NO_IMAGE_PATH);
    }

    public function getImage(): string
    {
        $path = public_path($this->picture);

        if($this->picture && is_file($path) && file_exists($path)) {
            return asset($this->picture);
        }

        return Vite::asset(Enum::NO_IMAGE_PATH);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
