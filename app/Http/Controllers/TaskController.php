<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;
use App\Models\Tasks;

class TaskController extends Controller {

  public function index() {
    $tasks = Tasks::latest()->get()->sortBy('priority_order');

    return view('tasks/index', ['tasks' => $tasks, 'project' => null]);
  }

  public function new() {
    return view('tasks/new', ['projects' => Projects::all()]);
  }

  public function create(Request $request) {
    $validatedData = $request->validate([
      'name' => 'required|string',
      'description' => 'string',
      'dueDate' => 'required|date|after_or_equal:today',
      'priority' => 'required|in:high,medium,low',
      'project_id' => 'required|exists:projects,id',
    ]);

    //default status is 'pending'
    $validatedData['status'] = 'pending';

    Tasks::create([
      'name' => $validatedData['name'],
      'description' => $validatedData['description'],
      'due_date' => $validatedData['dueDate'],
      'priority' => $validatedData['priority'],
      'status' => $validatedData['status'],
      'project_id' => $validatedData['project_id'],
    ]);

    return redirect()->route('all-task')->with('success', __('Task created successfully'));
  }

  public function edit(Tasks $task) {
    return view('tasks/edit', ['task' => $task, 'projects' => Projects::all()]);
  }

  public function update(Request $request, Tasks $task) {
    $validatedData = $request->validate([
      'name' => 'required|string',
      'description' => 'nullable|string',
      'dueDate' => 'nullable|date',
      'priority' => 'required|in:high,medium,low',
      'status' => 'required|in:pending,in_progress,completed,canceled',
      'project_id' => 'required|exists:projects,id',
    ]);

    $task->update([
      'name' => $validatedData['name'],
      'description' => $validatedData['description'],
      'due_date' => $validatedData['dueDate'],
      'priority' => $validatedData['priority'],
      'status' => $validatedData['status'],
      'project_id' => $validatedData['project_id'],
    ]);

    return redirect()->route('all-task')->with('success', __('Task updated successfully'));
  }

  public function destroy(Tasks $task) {
    $task->delete();
    return redirect()->route('all-task')->with('success', __('Task deleted successfully'));
  }

  public function byProject(Projects $project) {
    return view('tasks/index', ['tasks' => $project->tasks, 'project' => $project]);
  }

  public function reorder(Request $request) {
    $startDraggedTask = Tasks::findOrFail((int) $request->start);
    $endDraggedTask = Tasks::findOrFail((int) $request->end);

    $startDraggedTask->update(['priority' => $endDraggedTask->priority]);

    return response()->json(['success' => true]);
  }
}
