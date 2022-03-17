<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */


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
     protected $table = 'sys.all_views';


    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //    protected $fillable = [
    //         'CODRUTA',
    //         'NOMBRE',
    //         'STADSINCRO'
    // ];

    public $timestamps = false;

    protected $casts = [
        'id' => 'integer',
    ];

     public function scopeSearch($query, $nombre)
       {
       return $query ->where('name','LIKE' ,  "%$nombre%");
       }

}
