@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/datatable.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/table.css') }}" />
@endsection

@section('title','History')

@section('content')
<div class="container">
  @if (Session::get('success'))
  <div class="result success">
    {{ Session::get('success') }}
  </div>
  @elseif (Session::get('fail'))
  <div class="result fail">
    {{ Session::get('fail') }}
  </div>
  @endif

  <div class="buttons">
    <a href="{{ route('export.history.excel') }}" @if(count($histories) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Excel</a>
    {{-- <a href="{{ route('export.history.csv') }}" @if(count($histories) === 0) disabled @endif class="button csv"><i class="fa fa-download"></i> CSV</a> --}}
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>Utilisateur</th>
        <th>Role</th>
        <th>Table</th>
        <th>Opération</th>
        <th>Date d'opération</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($histories as $history)
      <tr>
        <td>{{ $history->id }}</td>
        <td>{{ $history->user }}</td>
        <td>{{ $history->role }}</td>
        <td>{{ $history->table }}</td>
        <td class='operation_{{ $history->operation }}'>{{ $history->operation }}</td>
        <td>{{ $history->created_at }}</td>
        <td>
          <form method="POST" action="history/{{ $history->id }}">
            @csrf
            @method('DELETE')
            <a class="delete"><i class="fa fa-trash-o"></i></a>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/scripts/board/datatable.js') }}"></script>
<script>
  $('.grid').DataTable({
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
