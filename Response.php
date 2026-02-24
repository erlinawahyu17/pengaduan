<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'feedbacks';
    //
    protected $fillable= [
        'aspirasi_id', 'user_id', 'message'
    ];
    //
    public function user() {
        return $this->belongsTo(User::class);
  }

  public function aspirasi() {
    return $this->belongsTo(Aspirasi::class);
  }
}
