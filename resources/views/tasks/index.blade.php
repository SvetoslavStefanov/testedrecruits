@extends('layout')
@section('title')
  {{ __('All Task') }}
@endsection

@section('styles')
  <style>
    .dragging {
      opacity: 0.5;
      background-color: #f0f0f0;
    }

    .over {
      background-color: #f1f1f1;
    }
  </style>

@section('content')
  <div class="container">
    <div class="text-center">
      <h1>
        {{ __('All Task') }}
        @if (!empty($project))
          {{ __('for') }} {{ $project->name }}
        @endif
      </h1>
    </div>

    <table class="table mt-5">
      <thead>
      <tr>
        <th>ID</th>
        <th>{{ __('Task Name') }}</th>
        <th>{{ __('Priority') }}</th>
        <th>{{ __('Description') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __('Project') }}</th>
        <th>{{ __('Actions') }}</th>
      </tr>
      </thead>
      <tbody id="table-body">
      @foreach ($tasks as $task)
        <tr draggable="true" data-id="{{ $task->id }}" data-priority="{{ $task->priority }}">
          <td>{{ $task->id }}</td>
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
            <a href="{{ route('tasks-by-project', $task->project) }}">
              {{ $task->project->name }}
          </td>
          <td>
            <a href="{{ route('edit-task', $task) }}" class="btn btn-primary">{{ __('Edit') }}</a>

            <form action="{{ route('delete-task', $task) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this task?') }}');" class="d-inline">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <button class="btn btn-danger">{{ __('Delete') }}</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    const tableBody = document.getElementById('table-body');
    let dragged;

    tableBody.addEventListener('dragstart', (event) => {
      dragged = event.target;
      event.target.style.opacity = 0.5;
      event.target.classList.add('dragging');
    });

    tableBody.addEventListener('dragend', (event) => {
      event.target.style.opacity = "";
      event.target.classList.remove('dragging');
    });

    tableBody.addEventListener('dragover', (event) => {
      event.preventDefault();
    });

    //when the dragged item enters another item
    tableBody.addEventListener('dragenter', (event) => {
      let target = event.target.closest('tr');

      if (target !== dragged) {
        target.classList.add('over');
      }
    });

    //when the dragged item leaves another item
    tableBody.addEventListener('dragleave', (event) => {
      let target = event.target.closest('tr');

      if (target !== dragged) {
        target.classList.remove('over');
      }
    });

    //when the dragged item is dropped. Save the new order of the items
    tableBody.addEventListener('drop', async (event) => {
      event.preventDefault();
      let target = event.target.closest('tr');

      if (target.tagName === 'TR' && target !== dragged) {
        target.classList.remove('over');
        const bounding = target.getBoundingClientRect();
        const offset = bounding.y + (bounding.height / 2);
        const nextSibling = (event.clientY - offset) > 0 && typeof target.nextSibling?.tagName !== 'undefined' ? target.nextSibling : target;
        tableBody.insertBefore(dragged, nextSibling);

        //send all items to the backend
        let list = [];

        document.querySelectorAll('tbody tr')?.forEach((item, index) => {
          list.push(item.querySelector('td').innerText);
        });

        try {
          const response =  await fetch('{{ route('tasks.reorder') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: new URLSearchParams({
              list: list,
              start: dragged.dataset.id,
              end: nextSibling ? nextSibling.dataset.id : null
            }).toString()
          });

          if (response.ok) {
            console.log('Items reordered successfully');
            dragged.dataset.priority = nextSibling.dataset.priority;
            dragged.querySelector('td:nth-child(3)').innerText = nextSibling.dataset.priority;
          } else {
            console.error('Failed to reorder items');
          }
        } catch (error) {
          console.error('Failed to reorder items', error);
        }
      }
    });
  </script>
@endsection
