<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory,Notifiable;
protected $fillable = [
    'user_id',
    'shipping_phonenumber',
    'shipping_city',
    'shipping_postalcode',
    'product_id',
    'quantity',
    'totalprice'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

