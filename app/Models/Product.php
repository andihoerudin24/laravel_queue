<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";


    public function priorites()
    {
        return $this->belongsTo(PriorityModel::class,'id_priorities','id');
    }
}
