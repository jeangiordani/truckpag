<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';
    protected $fillable = ['public_place', 'number', 'district', 'city_id'];

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
