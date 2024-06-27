<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input_P3K extends Model
{
    use HasFactory;

    protected $table = 'input_p3k';

    protected $fillable = [
        'namaPJ',
        'kotak',
        'nama_Barang', 
        'quantity', 
        'keperluan', 
        'tanggal'
    ];

    public function kotak()
    {
        return $this->belongsTo(Kotak::class, 'kotak_id');
    }

    public function datap3ks()
    {
        return $this->belongsTo(Data_P3K::class, 'data_p3ks_id');
    }
    
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
