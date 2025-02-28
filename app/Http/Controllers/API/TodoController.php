<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $todos = $request->user()->todos()->orderBy('created_at', 'desc')->get();
        return response()->json($todos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable|boolean',
            'due_date' => 'nullable|date',
        ]);

        $todo = $request->user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->completed ?? false,
            'due_date' => $request->due_date,
        ]);

        return response()->json($todo, 201);
    }

    public function show(Request $request, $id)
    {
        $todo = $request->user()->todos()->findOrFail($id);
        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
            'due_date' => 'nullable|date',
        ]);

        $todo = $request->user()->todos()->findOrFail($id);
        $todo->update($request->all());

        return response()->json($todo);
    }

    public function destroy(Request $request, $id)
    {
        $todo = $request->user()->todos()->findOrFail($id);
        $todo->delete();

        return response()->json(null, 204);
    }
}
