<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSchedule extends Model {
    
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'booking_date',
        'event_location',
        'event_name',
        'status_booking',
    ];
}
