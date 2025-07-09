<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'plate_number',
        'type',
        'ownership',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
