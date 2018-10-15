<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MPortofolio extends Model {
    
    protected $table = 'portofolio';
    protected $primaryKey = 'id_portofolio';

    public $timestamps = false;

    protected $fillable = [
        'portofolio_name',
        'portofolio_description',
        'portofolio_photo',
    ];
}
