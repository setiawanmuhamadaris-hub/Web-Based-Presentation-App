<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Pastikan mengimpor Str

class MasterTutorial extends Model
{
    protected $fillable = [
        'judul', 'kode_matkul', 'url_presentation', 'url_finished', 'creator_email'
    ];

    public function details()
    {
        return $this->hasMany(DetailTutorial::class);
    }

    // Logika Auto Slug
    protected static function boot()
{
    parent::boot();

    // Berjalan saat Create maupun Update
    static::saving(function ($tutorial) {
        
        if ($tutorial->isDirty('judul')) {
            $slug = Str::slug($tutorial->judul);
            
            $uniqueString = bin2hex(random_bytes(8)); 

            $tutorial->url_presentation = $slug . '-' . $uniqueString;
            $tutorial->url_finished = $slug . '-finished-' . $uniqueString;
        }
    });
}
}