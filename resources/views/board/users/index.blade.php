@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/datatable.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/table.css') }}" />
@endsection

@section('title','Users')

@section('content')
<div class="container">

  <div class="buttons">
    <a href="{{ route('export.users.excel') }}" @if(count($users) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Excel</a>
    {{-- <a href="{{ route('export.users.csv') }}" @if(count($users) === 0) disabled @endif class="button csv"><i class="fa fa-download"></i> CSV</a> --}}
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>Nom</th>
        <th>E-mail</th>
        <th>Role</th>
        <th></th>
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
        <td>
          <form method="POST" action="users/{{ $user->id }}">
            @csrf
            @method('DELETE')
            <a class="delete"><i class="fa fa-trash-o"></i></a>
          </form>
        </td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
</div>
{{-- <a class="add" href="/users/create"><i class="fa fa-plus-circle"></i></a> --}}
@endsection
@section('scripts')
<script src="{{ asset('assets/scripts/board/datatable.js') }}"></script>
<script>
  $('.grid').DataTable({
    ordering: false,
    language: {
      url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
    }
  });
  const deleteButtons = Array.from(document.querySelectorAll('a.delete'));
  deleteButtons.forEach(function (item) {
    item.addEventListener('click', () => {
      let sure = confirm('Are You sure about that');
      if (sure) {
        item.parentElement.submit();
      }
    });
  });
</script>
@endsection
