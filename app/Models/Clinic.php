<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = ['user_id', 'name', 'address', 'phone', 'services',];

    protected $casts = [
        'services' => 'array', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
