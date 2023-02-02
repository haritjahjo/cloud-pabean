<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WhyHeader extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    public function whyFaqs():BelongsToMany
    {
        return $this->belongsToMany(WhyFaq::class );
    }
}
