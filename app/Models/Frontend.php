<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Frontend extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['title', 'excerpt', 'is_visible'];


    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('main')
            ->performOnCollections('frontend')
            ->crop('crop-center', 780, 646)
            ->nonQueued();

        $this
            ->addMediaConversion('preview')
            ->performOnCollections('frontend')
            ->crop('crop-center', 300, 300)
            ->nonQueued();
    }

    // public static function last()
    // {
    //     return static::all()->last();
    // }
}
