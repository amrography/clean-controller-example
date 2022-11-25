<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'body'];

    //----------- Getters

    public function getImageUrlAttribute()
    {
        return Storage::disk('public')
            ->url($this->image);
    }
}
