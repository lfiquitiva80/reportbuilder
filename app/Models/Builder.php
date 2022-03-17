<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Builder extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'id';
    protected $guarded = ['id'];



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
     protected $table = 'QueriesDuquesa';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
