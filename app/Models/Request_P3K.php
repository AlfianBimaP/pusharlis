<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_P3K extends Model
{
    use HasFactory;

    protected $table = 'request_p3k';

    protected $fillable = [
        'namaPJ', 
        'kotak', 
        'namaBarang',
        'quantity',
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
        return $this->belongsTo(User::class, 'user_id');
    }
}
