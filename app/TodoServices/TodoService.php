<?php 

namespace App\TodoServices;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoService
{

    public function index($userId)
    {
        $todos = Todo::where('user_id', $userId)->paginate(15);
        return [
            'status' => 'success',
            'todos' => $todos,
        ];
    }

    public function store(Request $request, int $userId)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $todo = Todo::create([
            'title' => $request->title,
            'user_id' => $userId,
        ]);

        return [
            'status' => 'success',
            'message' => 'Todo created successfully',
            'todo' => $todo,
        ];
    }

    public function show($id, $userId)
    {
        $todo = Todo::where('user_id', $userId)->where('id', $id)->first();

        if($todo == null) {
            return [
                'status' => 'failed',
                'todo' => $todo,
            ];
        }

        return [
            'status' => 'success',
            'todo' => $todo,
        ];
    }

    public function update(Request $request, $id, $userId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo = Todo::where('user_id', $userId)->where('id', $id)->first();
        if($todo == null) {
            return [
                'status' => 'failed',
                'todo' => $todo,
            ];
        }

        $todo->title = $request->title;
        $todo->save();

        return [
            'status' => 'success',
            'message' => 'Todo updated successfully',
            'todo' => $todo,
        ];
    }

    public function destroy($id, $userId)
    {
        $todo = Todo::where('user_id', $userId)->where('id', $id)->first();

        if($todo == null) {
            return [
                'status' => 'failed',
                'todo' => $todo,
            ];
        }

        $todo->delete();

        return [
            'status' => 'success',
            'message' => 'Todo deleted successfully',
            'todo' => $todo,
        ];
    }
}