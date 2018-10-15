<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MPengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'jumlah',
    ];
}
