<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    use HasFactory;
    protected $table = 'pickuppoints';
    protected $fillable = ['category_id','pickup_point_name','pickup_point_address','pickup_point_phone','pickup_point_phone_two'];
}
