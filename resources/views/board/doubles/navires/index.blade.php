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

@section('title','Doublons des Navires')

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
    <a href="/doubles/navires/export" @if(count($d_navires) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Export</a>

    <form class="d-flex" method='POST' action="/doubles/navires/import" enctype="multipart/form-data">
      @csrf
      <div>
        <input type="file" id='navires' name="navires" />
        <span class="error">@error('navires') {{ $message }} @enderror</span>
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
        <th>Categorie</th>
        {{-- <th>Type</th> --}}
        <th>Armateur</th>
        <th>Count</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($d_navires as $d_navire)
      <tr>
        <td>{{ $d_navire->id }}</td>

        <td>{{ $d_navire->matricule }}</td>
        <td>{{ $d_navire->nom }}</td>
        {{-- <td>{{ $d_navire->portattache }}</td> --}}
        <td>{{ $d_navire->categorie }}</td>
        {{-- <td>{{ $d_navire->scategorie }}</td> --}}
        {{-- <td>{{ $d_navire->type }}</td> --}}
        {{-- <td>{{ $d_navire->type_dem }}</td> --}}
        {{-- <td>{{ $d_navire->date_immatriculation }}</td> --}}
        {{-- <td>{{ $d_navire->quartier_maritime }}</td> --}}
        <td>{{ $d_navire->armateur }}</td>

        <td>{{ $d_navire->count }}</td>
        <td><a class="edit" href="/doubles/navires/show/{{ $d_navire->id }}"><i class="fa fa-info"></i></a></td>
        <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/navires/fusionnes/{{ $d_navire->id }}">Fusionnes</a></td>
        <td>
          <form method="POST" action="/doubles/navires/{{ $d_navire->id }}">
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
