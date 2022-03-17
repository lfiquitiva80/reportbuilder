<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependence extends Model
{
    use HasFactory;


                /**
     * The database connection used by the model.
     *
     * @var string
     */
     protected $connection = 'sqlserver';

     /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table = 'MTDEPEN';


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'DEPEN' => 'integer',
    ];
}
