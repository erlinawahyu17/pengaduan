<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $fillable = [
        'kategori_id','user_id', 'title', 'description', 'status','photo',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    //
    public function responses() {
        return $this->hasMany(Response::class);
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}
