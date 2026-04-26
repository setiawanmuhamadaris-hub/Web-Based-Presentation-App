<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTutorial extends Model
{
    protected $fillable = [
        'judul', 'kode_matkul', 'url_presentation', 'url_finished', 'creator_email'
    ];

    public function details()
    {
        return $this->hasMany(DetailTutorial::class);
    }
}