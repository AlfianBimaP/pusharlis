<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Data_P3K;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'role'
    ];

    public function dataP3Ks()
    {
        return $this->belongsToMany(Data_P3K::class, 'lemari')
            ->withPivot('quantity', 'exp_date')
            ->withTimestamps();
    }

}
