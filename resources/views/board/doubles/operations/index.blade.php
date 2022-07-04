@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/datatable.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/table.css') }}" />
<style>
.grid {
  font-size: 14px;
}
</style>
@endsection

@section('title','Doublons des Operations')

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
    <a href="/doubles/operations/export" @if(count($d_operations) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Export</a>

    {{--
    <form class="d-flex" method='POST' action="/doubles/operations/import" enctype="multipart/form-data">
      @csrf
      <div>
        <input type="file" id='operations' name="operations" />
        <span class="error">@error('operations') {{ $message }} @enderror</span>
      </div>
      <button class="button import"><i class="fa fa-upload"></i> Import</button>
    </form>
    --}}
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>Type</th>
        <th>Operation date</th>
        <th>Navire</th>
        <th>Count</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($d_operations as $d_operation)
      <tr>
        <td>{{ $d_operation->id }}</td>
        <td>{{ $d_operation->type }}</td>
        <td>{{ $d_operation->operation_date }}</td>
        <td>{{ $d_operation->navire }}</td>
        <td>{{ $d_operation->count }}</td>
        <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/operations/fusionner/{{ $d_operation->id }}">Fusionner</a></td>
        <td>
          <form method="POST" action="/doubles/operations/{{ $d_operation->id }}">
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
