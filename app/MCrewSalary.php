<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MCrewSalary extends Model {
    
    protected $table = 'crew_salary';
    protected $primaryKey = 'id_crew_salary';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_booking',
        'payment_date',
        'salary',
        'status_salary',
    ];
}
