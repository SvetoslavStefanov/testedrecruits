<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;

class TaskController extends Controller {

  public function index() {
    $tasks = Tasks::latest()->get();

    //Sort tasks
    $tasks = $tasks->sortBy(function ($task) {
      $priorityOrder = [
        'high' => 1,
        'medium' => 2,
        'low' => 3,
      ];

      $statusOrder = [
        'completed' => 2,
        'canceled' => 2,
      ];

      return [
        $statusOrder[$task->status] ?? 1, // Completed and canceled tasks have higher sort order
        $priorityOrder[$task->priority],
      ];
    });

    return view('tasks/index', compact('tasks'));
  }

  public function new() {
    return view('tasks/new');
  }

  public function create(Request $request) {
    $validatedData = $request->validate([
      'name' => 'required|string',
      'description' => 'string',
      'dueDate' => 'required|date|after_or_equal:today',
      'priority' => 'required|in:high,medium,low'
    ]);

    //default status is 'pending'
    $validatedData['status'] = 'pending';

    Tasks::create([
      'name' => $validatedData['name'],
      'description' => $validatedData['description'],
      'due_date' => $validatedData['dueDate'],
      'priority' => $validatedData['priority'],
      'status' => $validatedData['status'],
    ]);

    return redirect()->route('all-task')->with('success', __('Task created successfully'));
  }
}
