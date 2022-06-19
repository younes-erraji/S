@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/datatable.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/table.css') }}" />
@endsection

@section('title','Armateurs')

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
    <a href="{{ route('export.armateurs.excel') }}" @if(count($armateurs) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Export</a>
    {{-- <a href="{{ route('export.armateurs.csv') }}" @if(count($armateurs) === 0) disabled @endif class="button csv"><i class="fa fa-download"></i> CSV</a> --}}
    <a href="{{ route('import.armateurs') }}" class="button import"><i class="fa fa-upload"></i> Import</a>
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>Identite</th>
        <th>Nom</th>
        <th>Prenom</th>
        {{-- <th>Nom Court</th> --}}
        <th>E-mail</th>
        {{-- <th>Type</th> --}}
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($armateurs as $armateur)
      <tr>
        <td>{{ $armateur->id }}</td>
        <td>{{ $armateur->identite }}</td>
        <td>{{ $armateur->nom }}</td>
        <td>{{ $armateur->prenom }}</td>
        {{-- <td>{{ $armateur->nom_court }}</td> --}}
        <td>{{ $armateur->email }}</td>
        {{-- <td>{{ $armateur->type }}</td> --}}
        <td><a class="edit" href="armateurs/show/{{ $armateur->id }}"><i class="fa fa-info"></i></a></td>
        <td><a class="edit" href="armateurs/{{ $armateur->id }}/edit"><i class="fa fa-pencil"></i></a></td>
        <td>
          <form method="POST" action="armateurs/{{ $armateur->id }}">
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
{{-- <a class="add" href="/armateurs/create"><i class="fa fa-plus-circle"></i></a> --}}
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
