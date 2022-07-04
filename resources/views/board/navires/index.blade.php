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

@section('title','Navires')

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
    <a href="{{ route('export.navires.excel') }}" @if(count($navires) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Export</a>
    <form class="d-flex" method='POST' action="{{ route('import.navires') }}" enctype="multipart/form-data">
      @csrf
      <div>
        <input type="file" id='excel-navires' name="excel-navires" />
        <span class="error">@error('excel-navires') {{ $message }} @enderror</span>
      </div>
      <button class="button import"><i class="fa fa-upload"></i> Import</button>
    </form>
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>Matricule</th>
        <th>Nom</th>
        <th>Portattache</th>
        <th>Categorie</th>
        {{-- <th>SCategorie</th>
        <th>Type</th>
        <th>Type Dem</th>
        <th>Date Immatriculation</th> --}}
        {{-- <th>Quartier Maritime</th> --}}
        {{-- <th>Armateur</th> --}}
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($navires as $navire)
      <tr>
        <td>{{ $navire->id }}</td>
        <td>{{ $navire->matricule }}</td>
        <td>{{ $navire->nom }}</td>
        <td>{{ $navire->portattache }}</td>
        <td>{{ $navire->categorie }}</td>
        {{-- <td>{{ $navire->scategorie }}</td>
        <td>{{ $navire->type }}</td>
        <td>{{ $navire->type_dem }}</td>
        <td>{{ $navire->date_immatriculation }}</td>
        <td>{{ $navire->quartier_maritime }}</td> --}}
        {{-- @if (isset($navire->Armateur))
        <td>{{ $navire->Armateur->nom . ' ' . $navire->Armateur->prenom }}</td>
        @else
        <td></td>
        @endif --}}
        <td><a class="edit" href="navires/show/{{ $navire->id }}"><i class="fa fa-info"></i></a></td>
        <td><a class="edit" href="navires/{{ $navire->id }}/edit"><i class="fa fa-pencil"></i></a></td>
        <td>
          <form method="POST" action="navires/{{ $navire->id }}">
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
{{-- <a class="add" href="/navires/create"><i class="fa fa-plus-circle"></i></a> --}}
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
