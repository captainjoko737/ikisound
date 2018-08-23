<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MBookingPackage extends Model {
    
    protected $table = 'booking_package';
    protected $primaryKey = 'id_booking_package';

    public $timestamps = false;

    protected $fillable = [
        'id_package',
        'id_booking',
    ];
}
