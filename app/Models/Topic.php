<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Topic extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'description'];

    // protected $casts = [
    //     'is_v' => 'boolean',
    // ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('topic')
            ->performOnCollections('topics')
            ->crop('crop-center', 780, 646)
            ->nonQueued();

        $this
            ->addMediaConversion('preview')
            ->performOnCollections('topics')
            ->crop('crop-center', 300, 300)
            ->nonQueued();
    }
}
