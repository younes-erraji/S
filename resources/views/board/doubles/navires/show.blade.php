@extends('layouts.board')
@section('style')
<link rel='stylesheet' href="{{ asset('assets/styles/board/show.css') }}" />
@endsection

@section('title','Navire')

@section('content')

<div class="container">
  <div class="subcontainer">
  <table class="grid half">
    <tbody class="t-body">
      <tr>
        <th># &nbsp;</th>
        <td>{{ $d_navire->id }}</td>
      </tr>
      <tr>
        <th>Nom: &nbsp;</th>
        <td>{{ $d_navire->nom }}</td>
      </tr>
      <tr>
        <th>Categorie: &nbsp;</th>
        <td>{{ $d_navire->categorie }}</td>
      </tr>
      <tr>
        <th>SCategorie: &nbsp;</th>
        <td>{{ $d_navire->scategorie }}</td>
      </tr>
      <tr>
        <th>Date Immatriculation: &nbsp;</th>
        <td>{{ $d_navire->date_immatriculation }}</td>
      </tr>
      <tr>
        <th>Armateur: &nbsp;</th>
        <td>{{ $d_navire->armateur }}</td>
      </tr>
    </tbody>
  </table>
  <table class="grid half">
    <tbody class="t-body">
      <tr>
        <th>Matricule: &nbsp;</th>
        <td>{{ $d_navire->matricule }}</td>
      </tr>
      <tr>
        <th>Portattache: &nbsp;</th>
        <td>{{ $d_navire->portattache }}</td>
      </tr>
      <tr>
        <th>Type: &nbsp;</th>
        <td>{{ $d_navire->type }}</td>
      </tr>
      <tr>
        <th>Type Dem: &nbsp;</th>
        <td>{{ $d_navire->type_dem }}</td>
      </tr>
      <tr>
        <th>Quartier Maritime: &nbsp;</th>
        <td>{{ $d_navire->quartier_maritime }}</td>
      </tr>
      <tr>
        <th class='actions'>
          <a style='width: auto;' class="action edit" href="/doubles/navires/fusionner/{{ $d_navire->id }}">Fusionner</a>
          <form method="POST" action="/navires/{{ $d_navire->id }}">
            @csrf
            @method('DELETE')
            <a class="action delete"><i class="fa fa-trash-o"></i></a>
          </form>
        </th>
      </tr>
    </tbody>
  </table>
  </div>
</div>
@endsection

@section('scripts')
<script>
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
