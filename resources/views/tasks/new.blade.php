@extends('layout')
@section('title')
  {{ __('Add new Task') }}
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center">{{ __('Add new task') }}</h1>

    <div class="row mt-3">
      <div class="col-md-6 offset-md-3">
        <form action="{{ route('add-task') }}" method="POST">
          @csrf

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <div class="form-group">
            <label>{{ __('Task Name') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group mt-2">
            <label>{{ __('Task Description') }}</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group mt-2">
            <label>{{ __('Due Date') }}</label>
            <input type="datetime-local" class="form-control @error('dueDate') is-invalid @enderror" name="dueDate" value="{{ old('dueDate') }}">
            @error('dueDate')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group mt-2">
            <label>{{ __('Priority') }}</label>
            <select class="form-control @error('priority') is-invalid @enderror" name="priority">
              <option value="">{{ __('Select Priority Level') }}</option>
              <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>{{ __('High') }}</option>
              <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>{{ __('Medium') }}</option>
              <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>{{ __('Low') }}</option>
            </select>
            @error('priority')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mt-2">
            <label>{{ __('Project') }}</label>
            <select class="form-control @error('project') is-invalid @enderror" name="project_id">
              <option value="">{{ __('Select Project') }}</option>
              @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ old('project') == $project->id ? 'selected' : '' }}>
                  {{ $project->name }}
                </option>
              @endforeach
            </select>
            @error('project')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary mt-2">{{ __('Add Task') }}</button>
        </form>
      </div>
    </div>
  </div>
@endsection