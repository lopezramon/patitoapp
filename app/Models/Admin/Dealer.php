<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dealer
 * @package App\Models\Admin
 * @version August 31, 2019, 3:50 am UTC
 *
 * @property string email
 * @property string login
 * @property string name
 * @property string password
 */
class Dealer extends Model
{
    
    use SoftDeletes;
    
    public $table = 'Dealers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    
    protected $dates = ['deleted_at'];
    
    
    public $fillable = [
        'email',
        'login',
        'name',
        'password'
    ];
    
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string',
        'login' => 'string',
        'name' => 'string',
        'password' => 'string'
    ];
    
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required',
        'login' => 'required',
        'name' => 'required',
        'password' => 'required'
    ];
}

