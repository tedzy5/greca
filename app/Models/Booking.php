<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'product_id', 'booked_on'];

    public function clients(): BelongsTo {
        return $this->belongsTo(Client::class);
    }

    public function products(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
