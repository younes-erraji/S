@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/datatable.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/table.css') }}" />
<style>
  .container {
    margin-top: 0 !important;
  }
</style>
@endsection

@section('title',' users ')

@section('content')
<div class="container">

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>name</th>
        <th>email</th>
        <th>role</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      @if (!($user->role($user)->display_name === 'Superadministrator'))
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td> {{ $user->role($user)->display_name }} </td>
        <td><a class="edit" href="/users/{{ $user->id }}/edit"><i class="fa fa-pencil"></i></a></td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/scripts/board/datatable.js') }}"></script>
<script>
  $(document).ready( function () {
    $('.grid').DataTable();
  });
</script>
@endsection
