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
}
