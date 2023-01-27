<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'table_id' , 'email','tel_number','res_date','guest_number', 'user_id', 'category_id'];

    public function tables()
    {
        return $this->belongsTo(Table::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsTo(category::class);
    }
}
