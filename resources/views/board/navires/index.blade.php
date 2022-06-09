@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/datatable.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/table.css') }}" />
@endsection

@section('title',' Navires ')

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
    <a href="{{ route('export.navires.excel') }}" @if(count($navires) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Excel</a>
    <a href="{{ route('export.navires.csv') }}" @if(count($navires) === 0) disabled @endif class="button csv"><i class="fa fa-download"></i> CSV</a>
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>matricule</th>
        <th>nom</th>
        <th>email</th>
        <th>portattache</th>
        <th>categorie</th>
        <th>scategorie</th>
        <th>type</th>
        <th>type dem</th>
        <th>date immatriculation</th>
        <th>quartier maritime</th>
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
        <td>{{ $navire->email }}</td>
        <td>{{ $navire->portattache }}</td>
        <td>{{ $navire->categorie }}</td>
        <td>{{ $navire->scategorie }}</td>
        <td>{{ $navire->type }}</td>
        <td>{{ $navire->type_dem }}</td>
        <td>{{ $navire->date_immatriculation }}</td>
        <td>{{ $navire->quartier_maritime }}</td>
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
<a class="add" href="/navires/create"><i class="fa fa-plus-circle"></i></a>
@endsection
@section('scripts')
<script src="{{ asset('assets/scripts/board/datatable.js') }}"></script>
<script>
  $('.grid').DataTable();
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
