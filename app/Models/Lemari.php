<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lemari extends Model
{
    use HasFactory;

    protected $table = 'lemari';
    protected $fillable = [
        'user_id',
        'data_p3k_id',
        'quantity',
        'exp_date',
    ];

     

    // public function kotaks()
    // {
    //     return $this->belongsTo(Kotak::class, 'kotak_id');
    // }
    // // public function user()
    // // {
    // //     return $this->belongsTo(Users::class, 'user_id');
    // // }

    // public function dataP3K()
    // {
    //     return $this->belongsTo(Data_P3K::class, 'data_p3ks_id');
    // }
}

