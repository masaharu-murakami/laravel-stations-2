<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model{
    use HasFactory;

    // マスアサインメントを許可するカラム
    protected $fillable = ['column', 'row'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
