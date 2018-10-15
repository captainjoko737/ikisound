<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MBooking extends Model {
    
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';

    public $timestamps = false;

    protected $fillable = [
        'id_booking',
        'booking_date',
        'event_location',
        'event_name',
        'discount_offer',
        'customer_offer',
        'approved_offer',
        'status_booking',
    ];
}
