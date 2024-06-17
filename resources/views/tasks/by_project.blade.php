@extends('layout')
@section('title')
  {{ __('Task By Project') }}
@endsection

@section('content')
  <div class="container">
    <h1 class="text-center">{{ __('Task by Project') }}</h1>

    @if($tasks->isEmpty())
      <h1 class="text-center mt-5">{{ __('No tasks found') }}</h1>
    @else
      <table class="table">
        <thead>
        <tr>
          <th>{{ __('Task Name') }}</th>
          <th>{{ __('Description') }}</th>
          <th>{{ __('Status') }}</th>
          <th>{{ __('Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tasks as $task)
          <tr>
            <td>{{ $task->name }}</td>
            <td>{{ $task->description }}</td>
            <td>
              @php
                $statusClass = '';
                switch ($task->status) {
                    case 'pending':
                        $statusClass = 'primary';
                        $status = "Pending";
                        break;
                    case 'in_progress':
                        $statusClass = 'info';
                        $status = "In Progress";
                        break;
                    case 'completed':
                        $statusClass = 'success';
                        $status = "Completed";
                        break;
                    case 'canceled':
                        $statusClass = 'danger';
                        $status = "Canceled";
                        break;
                    default:
                        $statusClass = 'secondary';
                }
              @endphp

              <span class="btn btn-{{ $statusClass }}">
                  {{ ucfirst($status) }}
              </span>
            </td>
            <td>
              <a href="{{ route('edit-task', ['id' => $task->id]) }}" class="btn btn-primary">{{ __('Edit') }}</a>
              <button class="btn btn-danger" onclick="confirmDelete({{ $task->id }})">{{ __('Delete') }}</button>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    @endif
  </div>
@endsection

@section('scripts')
  {{-- Add your scripts here --}}
  <script>
    function confirmDelete(taskId) {
      if (confirm('Are you sure you want to delete this task?')) {
        window.location.href = "{{ route('delete-task', ['id' => '__taskId__']) }}".replace('__taskId__', taskId);
      }
    }
  </script>
@endsection