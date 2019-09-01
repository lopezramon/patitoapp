<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Task;
use InfyOm\Generator\Common\BaseRepository;

use function GuzzleHttp\Promise\task;

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
     * Return searchable fields
     *
     * @return array
     */
    public function search($filter)
    {
        $tasks = $this->model->search($filter)->get();
        $numTasks = array();
        
        foreach ($tasks as $task) {    
            $repeat=false;
            for($i=0;$i<count($numTasks);$i++)
            {
                if($numTasks[$i]['name']==$task['name'])
                {   
                    $numTasks[$i]['items']+= 1 ;
                    $repeat=true;
                }
            }
            if($repeat==false)
                $numTasks[] = array('name' => $task['name'], 'items' => 1);

        }
        //add search date in array()
        $searchDate['date'] = $filter;
        array_push($numTasks,$searchDate);

        return $numTasks;
    }

    

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Task::class;
    }
}
