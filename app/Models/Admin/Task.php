<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Task
 * @package App\Models\Admin
 * @version August 31, 2019, 3:50 am UTC
 *
 * @property \App\Models\Admin\Distributor idDistributor
 * @property string date
 * @property string name
 * @property string address
 * @property float latitude
 * @property float length
 * @property integer merchandise
 * @property string status
 * @property integer id_dealer
 */
class Task extends Model
{
    use SoftDeletes;

    public $table = 'tasks';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'date',
        'name',
        'address',
        'latitude',
        'length',
        'merchandise',
        'status',
        'id_dealer'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'string',
        'name' => 'string',
        'address' => 'string',
        'latitude' => 'float',
        'length' => 'float',
        'merchandise' => 'integer',
        'status' => 'string',
        'id_dealer' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'date' => 'required',
        'name' => 'required',
        'address' => 'required',
        'latitude' => 'required',
        'length' => 'required',
        'merchandise' => 'required',
        'status' => 'required',
        'id_dealer' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function idDistributor()
    {
        return $this->belongsTo(\App\Models\Admin\Distributor::class, 'id_dealer');
    }
}
