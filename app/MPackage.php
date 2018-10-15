<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MPackage extends Model {

    protected $table = 'package';
    protected $primaryKey = 'id_package';

    public $timestamps = false;

    protected $fillable = [
        'package_name',
        'package_description',
        'package_price',
        'package_photo',
    ];
}
