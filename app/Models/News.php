<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use HTMLPurifier;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $fillable = ['user_id', 'news_category_id', 'title', 'description', 'image', 'status'];

    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => htmlspecialchars($value),
            get: fn ($value) => htmlspecialchars_decode($value),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function news_category()
    {
        return $this->hasOne(NewsCategory::class, 'id', 'news_category_id');
    }
}
