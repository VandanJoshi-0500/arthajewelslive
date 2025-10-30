<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistOrder extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(WishlistOrderItem::class, 'wishlist_id');
    }
}
