<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Dealer;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DealerRepository
 * @package App\Repositories\Admin
 * @version August 31, 2019, 5:08 am UTC
 *
 * @method Dealer findWithoutFail($id, $columns = ['*'])
 * @method Dealer find($id, $columns = ['*'])
 * @method Dealer first($columns = ['*'])
*/
class DealerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'login',
        'name',
        'password'
    ];
    
    /**
     * Return searchable fields
     *
     * @return array
     */
    public function search($filter)
    {
        return $this->model->search($filter);
    }
    
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Dealer::class;
    }
}
