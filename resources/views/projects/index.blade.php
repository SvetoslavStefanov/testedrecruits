@extends('layout')
@section('title')
  {{ __('All Projects') }}
@endsection

@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-left">
          <h2>{{ __('All Projects') }}</h2>
        </div>
        <div class="pull-right mb-2">
          <a class="btn btn-success" href="{{ route('projects.create') }}">{{ __('Create New Project') }}</a>
        </div>
      </div>
    </div>

    <table class="table table-bordered">
      <tr>
        <th>ID</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Description') }}</th>
        <th width="280px">{{ __('Action') }}</th>
      </tr>
      @foreach ($projects as $item)
        <tr>
          <td>{{ $item->id }}</td>
          <td>{{ $item->name }}</td>
          <td>{{ $item->description }}</td>
          <td>
            <form action="{{ route('projects.destroy', $item) }}" method="POST">
              @csrf
              @method('DELETE')

              <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
            </form>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
@endsection