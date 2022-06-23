@extends('layouts.board')
@section('style')
<link rel='stylesheet' href="{{ asset('assets/styles/board/show.css') }}" />
@endsection

@section('title','Navire')

@section('content')

<div class="container">
  <table class="grid">
    <tbody class="two-column">
      <tr>
        <th>#</th>
        <td>{{ $d_navire->id }}</td>

        <th>Matricule:</th>
        <td>{{ $d_navire->matricule }}</td>
      </tr>
      <tr>
        <th>Nom</th>
        <td>{{ $d_navire->nom }}</td>

        <th>Portattache</th>
        <td>{{ $d_navire->portattache }}</td>
      </tr>
      <tr>
        <th>Categorie</th>
        <td>{{ $d_navire->categorie }}</td>

        <th>Type</th>
        <td>{{ $d_navire->type }}</td>
      </tr>
      <tr>
        <th>SCategorie</th>
        <td>{{ $d_navire->scategorie }}</td>

        <th>Type Dem</th>
        <td>{{ $d_navire->type_dem }}</td>
      </tr>
      <tr>
        <th>Date Immatriculation</th>
        <td>{{ $d_navire->date_immatriculation }}</td>

        <th>Quartier Maritime</th>
        <td>{{ $d_navire->quartier_maritime }}</td>
      </tr>
      <tr>
        <th>Armateur</th>
        <td>{{ $d_navire->armateur }}</td>
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
