<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Kotak extends Model
{
    use HasFactory;

    protected $table = 'data_kotak';

    protected $fillable = [
        'kotak_id',
        'lemari_id',
        'quantity',
        'exp_date',
        'tanggal',
    ];
}
