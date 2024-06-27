<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Data_P3K extends Model
{
    use HasFactory;

    protected $table = 'data_p3ks';

    protected $fillable = [
        'item_name',
        'quantity',
        'exp_date',
    ];
    
    public function kotaks()
    {
        return $this->belongsToMany(Kotak::class, 'data_kotak', 'data_p3ks_id', 'kotak_id')
            ->withPivot('quantity', 'exp_date')
            ->withTimestamps();
    }
    

    public function users()
    {
        return $this->belongsToMany(Users::class, 'lemari')
            ->withPivot('quantity', 'exp_date')
            ->withTimestamps();
    }

}
