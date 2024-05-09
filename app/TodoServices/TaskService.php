<?php

namespace App\TodoServices;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Task;
use DateTime;

class TaskService
{
    public function index($todoId)
    {
        $tasks = Task::where('todo_id', $todoId)->paginate(15);
        $currentDate = new DateTime();

        foreach ($tasks as $task) {
            $currentTask = Task::find($task->id);
            $endDate = new DateTime($task->end_date);
            $diff = $endDate->diff($currentDate);

            if ($endDate >= $currentDate) {

                if ($diff->days >= 3) {
                    $currentTask->status = 'green';
                } else if ($diff->days <= 1) {
                    if ($diff->h >= 3 && $diff->h <= 24) {
                        $currentTask->status = 'yellow';
                    } else if ($diff->h < 3) {
                        $currentTask->status = 'red';
                    }
                }

                $task->save();
            }
        }
        return [
            'status' => 'success',
            'tasks' => $tasks,
        ];
    }

    public function store(Request $request, int $todoId)
    {
        $task = Task::create([
            'title' => $request->title,
            'todo_id' => $todoId,
            'description' => $request->description,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'status' => 'green',
        ]);

        return [
            'status' => 'success',
            'message' => 'task created successfully',
            'task' => $task,
        ];
    }

    public function show($todoId, $id)
    {
        $task = Task::where('todo_id', $todoId)->where('id', $id)->first();

        if ($task == null) {
            return [
                'status' => 'failed',
                'task' => $task,
            ];
        }

        //update the status of the task
        $currentDate = new DateTime();
        $endDate = new DateTime($task->end_date);
        $diff = $endDate->diff($currentDate);

        if ($endDate >= $currentDate) {

            if ($diff->days >= 3) {
                $task->status = 'green';
            } else if ($diff->days <= 1) {
                if ($diff->h >= 3 && $diff->h <= 24) {
                    $task->status = 'yellow';
                } else if ($diff->h < 3) {
                    $task->status = 'red';
                }
            }

            $task->save();
        }

        $task->save();


        return [
            'status' => 'success',
            'task' => $task,
        ];
    }

    public function update(Request $request, $todoId, $id)
    {

        $task = Task::where('todo_id', $todoId)->where('id', $id)->first();
        if ($task == null) {
            return [
                'status' => 'failed',
                'task' => $task,
            ];
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();

        return [
            'status' => 'success',
            'message' => 'task updated successfully',
            'task' => $task,
        ];
    }

    public function destroy($todoId, $id)
    {
        $task = Task::where('todo_id', $todoId)->where('id', $id)->first();

        if ($task == null) {
            return [
                'status' => 'failed',
                'task' => $task,
            ];
        }

        $task->delete();

        return [
            'status' => 'success',
            'message' => 'task deleted successfully',
            'task' => $task,
        ];
    }
}
