@extends('layout')
@section('title')
  {{ __('All Task') }}
@endsection

@section('content')
  <div class="container">
    <div class="text-center">
      <h1>{{ __('All Task') }}</h1>
    </div>

    <table class="table">
      <thead>
      <tr>
        <th>S/N</th>
        <th>{{ __('Task Name') }}</th>
        <th>{{ __('Priority') }}</th>
        <th>{{ __('Description') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Actions') }}</th>
      </tr>
      </thead>
      <tbody>
      @php $serialNumber = 1; @endphp
      @foreach ($tasks as $task)
        <tr>
          <td>{{ $serialNumber++ }}</td>
          <td>{{ $task->name }}</td>
          <td>{{ $task->priority }}</td>
          <td style="word-wrap: break-word; max-width: 300px;">{{ $task->description }}</td>
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
            <a href="{{ route('edit-task', $task) }}" class="btn btn-primary">{{ __('Edit') }}</a>
            <button class="btn btn-danger" onclick="document.querySelector('#delete-form').click();">{{ __('Delete') }}</button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection

<form action="{{ route('delete-task', $task) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this task?') }}');" class="d-none">
  <input type="hidden" name="_method" value="DELETE">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="submit" value="{{ __('Delete') }}" id="delete-form">
</form>
