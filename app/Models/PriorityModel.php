<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriorityModel extends Model
{
    use HasFactory;

    protected $table = "priorites";

    public function product()
    {
        return $this->hasMany(Product::class,'id_priorities','id');
    }
}
