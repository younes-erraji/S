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
        <td>{{ $navire->id }}</td>

        <th>Matricule:</th>
        <td>{{ $navire->matricule }}</td>
      </tr>
      <tr>
        <th>Nom</th>
        <td>{{ $navire->nom }}</td>

        <th>Portattache</th>
        <td>{{ $navire->portattache }}</td>
      </tr>
      <tr>
        <th>Categorie</th>
        <td>{{ $navire->categorie }}</td>

        <th>Type</th>
        <td>{{ $navire->type }}</td>
      </tr>
      <tr>
        <th>SCategorie</th>
        <td>{{ $navire->scategorie }}</td>

        <th>Type Dem</th>
        <td>{{ $navire->type_dem }}</td>
      </tr>
      <tr>
        <th>Date Immatriculation</th>
        <td>{{ $navire->date_immatriculation }}</td>

        <th>Quartier Maritime</th>
        <td>{{ $navire->quartier_maritime }}</td>
      </tr>
      <tr>
        <th>Armateur</th>
        <td>{{ $navire->Armateur->nom . ' ' . $navire->Armateur->prenom }}</td>

        <th class='actions'>
          <a class="action edit" href="/navires/{{ $navire->id }}/edit"><i class="fa fa-pencil"></i></a>
          <form method="POST" action="/navires/{{ $navire->id }}">
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
