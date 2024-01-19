<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Task::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->Task = $request->Task;
        $task->description = $request->description;
    
        // Parse and set the due date with 'Y-m-d' format
        $task->due_date = Carbon::parse($request->due_date)->format('Y-m-d');
    
        // Check if the task is past due
        $task->past_due = now()->greaterThan($task->due_date);
    
        $task->save();
        return $task;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['info' => 'successfully deleted a task.']);
    }

    /**
     * Mark task as completed
     *
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function complete(Task $task)
    {
        $task->completed_at = Carbon::now();
        $task->save();

        return response()->json(['info' => 'successfully marked a task as completed.']);
    }

    /**
     * Get completed tasks
     *
     * @return \Illuminate\Http\Response
     */
    public function completedTasks()
    {
        $completedTask = Task::whereNotNull('completed_at')->get();
        return $completedTasks;
    }

    /**
     * Get past due tasks
     *
     * @return \Illuminate\Http\Response
     */
    public function pastDueTasks()
    {
        $pastDueTasks = Task::where('due_date', '<', now())->whereNull('completed_at')->get();
        return $pastDueTasks;
    }
}
