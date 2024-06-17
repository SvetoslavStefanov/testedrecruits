<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

//no validations here, since I wanted to build a simple CRUD file ASAP
class ProjectController extends Controller {
  public function index() {
    return view('projects.index', ['projects' => Projects::all()]);
  }

  public function create() {
    return view('projects.new');
  }

  public function store(Request $request) {
    $request->validate([
      'name' => 'required',
      'description' => 'nullable',
    ]);

    Projects::create($request->all());
    return redirect()->route('projects.index')
      ->with('success', __('Item created successfully.'));
  }

  public function destroy(Projects $project) {
    $project->delete();

    return redirect()->route('projects.index')
      ->with('success', __('Projects deleted successfully.'));
  }
}
