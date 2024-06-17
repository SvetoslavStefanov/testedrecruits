@extends('layout')
@section('title')
  {{ __('Edit Task') }}
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center">{{ __('Edit Task') }}</h1>

    <div class="row mt-3">
      <div class="col-md-6 offset-md-3">
        <form action="{{ route('update-task', $task) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label>{{ __('Task Name') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $task->name) }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mt-2">
            <label>{{ __('Task Description') }}</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mt-2">
            <label>{{ __('Due Date') }}</label>
            <input type="datetime-local" class="form-control @error('dueDate') is-invalid @enderror" name="dueDate" value="{{ old('dueDate', now()->format('Y-m-d\TH:i')) }}">
            @error('dueDate')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mt-2">
            <label>{{ __('Priority') }}</label>
            <select class="form-control @error('priority') is-invalid @enderror" name="priority">
              <option value="">{{ __('Select Priority Level') }}</option>
              <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>{{ __('High') }}</option>
              <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>{{ __('Medium') }}</option>
              <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>{{ __('Low') }}</option>
            </select>
            @error('priority')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mt-2">
            <label>{{ __('Status') }}</label>
            <select class="form-control" name="status">
              <option value="">{{ __('Select Status') }}</option>
              <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
              <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>In {{ __('Progress') }}</option>
              <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
              <option value="canceled" {{ old('status', $task->status) === 'canceled' ? 'selected' : '' }}>{{ __('Canceled') }}</option>
            </select>
          </div>

          <div class="form-group mt-2">
            <label>{{ __('Project') }}</label>
            <select class="form-control @error('project') is-invalid @enderror" name="project_id">
              <option value="">{{ __('Select Project') }}</option>
              @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ old('project', $task->project_id) == $project->id ? 'selected' : '' }} data-test="{{ old('project', $task->project_id) }}">
                  {{ $project->name }}
                </option>
              @endforeach
            </select>
            @error('project')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary mt-2">{{ __('Update Task') }}</button>
        </form>
      </div>
    </div>
  </div>
@endsection