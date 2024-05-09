<?php

namespace App\Http\Controllers;

use App\TodoServices\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{

    private TodoService $todoService;

    public function __construct(TodoService $todoService) 
    {
        $this->todoService = $todoService;
    }

    public function index()
    {
        $user = Auth::user();
        return response()->json($this->todoService->index($user->id));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
         }

        $user = Auth::user();
        return response()->json($this->todoService->store($request, $user->id));

        
    }

    public function show($id)
    {
        return response()->json($this->todoService->show($id, Auth::user()->id));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
         }

        return response()->json($this->todoService->update($request, $id, Auth::user()->id));
    }

    public function destroy($id)
    {
        return response()->json($this->todoService->destroy($id, Auth::user()->id));
    }
}
