<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type', 'description', 'capacity'];

    public function bookings(): HasMany {
        return $this->hasMany(Booking::class, 'product_id');
    }
}
