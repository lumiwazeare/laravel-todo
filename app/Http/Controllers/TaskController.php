<?php

namespace App\Http\Controllers;

use App\TodoServices\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService) 
    {
        $this->taskService = $taskService;
    }

    public function index($todoId)
    {
        return response()->json($this->taskService->index($todoId));
    }

    public function store(Request $request, int $todoId)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'startDate' => 'date_format:Y-m-d H:i:s|after_or_equal:' . date(DATE_ATOM),
            'endDate' => 'required|date_format:Y-m-d H:i:s|after_or_equal:' . date(DATE_ATOM)
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
         }

      return response()->json($this->taskService->store($request, $todoId));
    }

    public function show($todoId,$id)
    {
        return response()->json($this->taskService->show($id, $todoId));
    }

    public function update(Request $request, $todoId, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
         }

        return response()->json($this->taskService->update($request, $id, $todoId));
    }

    public function destroy($todoId, $id)
    {
       return response()->json($this->taskService->destroy($id, $todoId));
    }
}
