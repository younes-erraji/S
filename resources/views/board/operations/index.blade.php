@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/datatable.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/table.css') }}" />
@endsection

@section('title','Operations')

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
    <a href="{{ route('export.operations.excel') }}" @if(count($operations) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Excel</a>

    <form class="d-flex" method='POST' action="{{ route('import.operations') }}" enctype="multipart/form-data">
      @csrf
      <div>
        <input type="file" id='excel-operations' name="excel-operations" />
        <span class="error">@error('excel-operations') {{ $message }} @enderror</span>
      </div>
      <button class="button import"><i class="fa fa-upload"></i> Import</button>
    </form>
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>Type</th>
        <th>Date d'opération</th>
        <th>Navire</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($operations as $operation)
      <tr>
        <td>{{ $operation->id }}</td>
        <td>{{ $operation->type }}</td>
        <td>{{ $operation->operation_date }}</td>
        <td>{{ $operation->Navire->nom }}</td>
        <td><a class="edit" href="operations/{{ $operation->id }}/edit"><i class="fa fa-pencil"></i></a></td>
        <td>
          <form method="POST" action="operations/{{ $operation->id }}">
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
{{-- <a class="add" href="/operations/create"><i class="fa fa-plus-circle"></i></a> --}}
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
