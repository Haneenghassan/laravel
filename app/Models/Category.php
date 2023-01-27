<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'tables_number'];
    public function reservations()
    {
        return $this->hasMany(Reservation::class,'category_id','id');
       
    }
}
