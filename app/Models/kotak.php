<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kotak extends Model
{
    use HasFactory;

    protected $table = 'kotaks';

    protected $fillable = [
        'username', 
        'firstname', 
        'lastname', 
        'email',
        'role'
    ];

    public function dataP3Ks()
    {
        return $this->belongsToMany(Data_P3K::class, 'data_kotak', 'kotak_id', 'data_p3ks_id')
                    ->withPivot('quantity', 'exp_date')
                    ->withTimestamps();
    }
}

