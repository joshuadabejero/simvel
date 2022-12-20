<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::orderBy('title', 'asc')->get();
        return response()->json($todo, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        $todo = Todo::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Todo successfully created.',
                'data' => $todo,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return response()->json($todo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        $todo = Todo::find($todo->id);

        if ($todo) {
            $todo->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Todo successfully updated.',
                'data' => $todo,
            ],
            200);
        }
        return response()->json(
            [
                'success' => false,
                'message' => 'Todo not found.',
            ],
            404
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if ($todo) {
            $todo->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Todo deleted.',
                ],
                200
            );
        }
        return response()->json(
            [
                'success' => false,
                'message' => 'Todo not found.',
            ],
            404
        );
    }
}
