<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = ['id', 'name'];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'city_id', 'id');
    }
}
