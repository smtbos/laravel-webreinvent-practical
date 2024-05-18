<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Todo::class);

        return view('todos');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $this->authorize('viewAny', Todo::class);

        $todos = Todo::userId();

        if ($request->filled('done')) {
            $todos->where('is_done', $request->done);
        }

        $datatable = DataTables::of($todos)
            ->make(true);

        return $datatable;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        $this->authorize('create', Todo::class);

        try {
            $todo = Todo::create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Todo created successfully',
                'data' => [
                    'todo' => $todo
                ]
            ], 201);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to create todo'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTodoRequest  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        try {
            $todo->update($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Todo updated successfully',
                'data' => [
                    'todo' => $todo
                ]
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update todo'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function updateDone(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        try {
            $todo->update([
                'is_done' => $request->is_done
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Todo marked as ' . ($request->is_done ? 'done' : 'undone') . ' successfully',
                'data' => [
                    'todo' => $todo
                ]
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to update todo'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        try {
            $todo->delete();

            return response()->json([
                'status' => true,
                'message' => 'Todo deleted successfully'
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete todo'
            ], 500);
        }
    }
}
