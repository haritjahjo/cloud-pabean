<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'answer', 'topic_id', 'is_visible'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
