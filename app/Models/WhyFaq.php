<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WhyFaq extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'answer'];

    public function whyHeaders(): BelongsToMany
    {
        return $this->belongsToMany(WhyHeader::class);
    }
}
