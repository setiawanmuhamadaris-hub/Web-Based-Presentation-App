<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTutorial extends Model
{
    protected $fillable = [
        'master_tutorial_id',
        'text',
        'gambar',
        'code',
        'url',
        'order',
        'status',
    ];

    public function masterTutorial(): BelongsTo
    {
        return $this->belongsTo(MasterTutorial::class);
    }
}