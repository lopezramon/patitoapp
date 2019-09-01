<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateTaskAPIRequest;
use App\Http\Requests\API\Admin\UpdateTaskAPIRequest;
use App\Models\Admin\Task;
use App\Repositories\Admin\TaskRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Cache;
use Response;

/**
 * Class TaskController
 * @package App\Http\Controllers\API\Admin
 */

class TaskAPIController extends AppBaseController
{
    /** @var  TaskRepository */
    private $taskRepository;

    public function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepository = $taskRepo;
    }

    /**
     * Display a listing of the Task.
     * GET|HEAD /tasks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->taskRepository->pushCriteria(new RequestCriteria($request));
        $this->taskRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tasks = $this->taskRepository->all();

    
        if ($request->has('searchdate')) {

            //Verification of key on cache
            if (Cache::has('searchdate')) {
                $value = Cache::get('searchdate');
                return $this->sendResponse($value, 'Number tasks - Value in cache successfully');
            }

            $filter = $request->get('searchdate');
            $tasksFilter = $this->taskRepository->search($filter);
            
            //addCache time 5min
            $expiresAt = now()->addMinutes(5);
            Cache::put('searchdate', $tasksFilter, $expiresAt);

            return $this->sendResponse($tasksFilter, 'Number tasks successfully');
        }

        return $this->sendResponse($tasks->toArray(), 'Tasks retrieved successfully');
    }

    /**
     * Store a newly created Task in storage.
     * POST /tasks
     *
     * @param CreateTaskAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskAPIRequest $request)
    {
        $input = $request->all();

        $task = $this->taskRepository->create($input);

        return $this->sendResponse($task->toArray(), 'Task saved successfully');
    }

    /**
     * Display the specified Task.
     * GET|HEAD /tasks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Task $task */
        $task = $this->taskRepository->findWithoutFail($id);

        if (empty($task)) {
            return $this->sendError('Task not found');
        }

        return $this->sendResponse($task->toArray(), 'Task retrieved successfully');
    }

    /**
     * Update the specified Task in storage.
     * PUT/PATCH /tasks/{id}
     *
     * @param  int $id
     * @param UpdateTaskAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskAPIRequest $request)
    {
        $input = $request->all();

        /** @var Task $task */
        $task = $this->taskRepository->findWithoutFail($id);

        if (empty($task)) {
            return $this->sendError('Task not found');
        }

        $task = $this->taskRepository->update($input, $id);

        return $this->sendResponse($task->toArray(), 'Task updated successfully');
    }

    /**
     * Remove the specified Task from storage.
     * DELETE /tasks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Task $task */
        $task = $this->taskRepository->findWithoutFail($id);

        if (empty($task)) {
            return $this->sendError('Task not found');
        }

        $task->delete();

        return $this->sendResponse($id, 'Task deleted successfully');
    }
}
