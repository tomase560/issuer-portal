<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone_number',
    ];

    public function user() {
        return $this->belongsTo(\App\Model\User::class);
    }

    public function connections() {
        return $this->hasMany(\App\Models\Connection::class);
    }
}
