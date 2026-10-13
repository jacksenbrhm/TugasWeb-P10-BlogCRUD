<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes; // SoftDeletes = BONUS soft delete

    protected $fillable = ['title', 'author', 'body', 'image'];

    /**
     * BONUS pencarian: Post::search('laravel')->get()
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, function (Builder $q, string $term) {
            $q->where(function (Builder $w) use ($term) {
                $w->where('title', 'like', "%{$term}%")
                  ->orWhere('author', 'like', "%{$term}%")
                  ->orWhere('body', 'like', "%{$term}%");
            });
        });
    }

    // $post->image_url -> URL gambar (null jika tidak ada gambar)
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // $post->excerpt -> cuplikan isi untuk kartu
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->body), 120);
    }
}
