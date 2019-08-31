<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Task;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TaskRepository
 * @package App\Repositories\Admin
 * @version August 31, 2019, 3:50 am UTC
 *
 * @method Task findWithoutFail($id, $columns = ['*'])
 * @method Task find($id, $columns = ['*'])
 * @method Task first($columns = ['*'])
*/
class TaskRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date',
        'name',
        'address',
        'latitude',
        'length',
        'merchandise',
        'status',
        'id_distributor'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Task::class;
    }
}
