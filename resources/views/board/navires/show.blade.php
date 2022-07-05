@extends('layouts.board')
@section('style')
<link rel='stylesheet' href="{{ asset('assets/styles/board/show.css') }}" />
<style>
  .listed {
    list-style: decimal
  }
  .listed li {
    padding: 10px 0;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
  }
</style>
@endsection

@section('title','Navire')

@section('content')

<div class="container">
  <div class="subcontainer">
  <table class="grid half">
    <tbody class="t-body">
      <tr>
        <th># &nbsp;</th>
        <td>{{ $navire->id }}</td>
      </tr>
      <tr>
        <th>Nom: &nbsp;</th>
        <td>{{ $navire->nom }}</td>
      </tr>
      <tr>
        <th>Categorie: &nbsp;</th>
        <td>{{ $navire->categorie }}</td>
      </tr>
      <tr>
        <th>SCategorie: &nbsp;</th>
        <td>{{ $navire->scategorie }}</td>
      </tr>
      <tr>
        <th>Date Immatriculation: &nbsp;</th>
        <td>{{ $navire->date_immatriculation }}</td>
      </tr>
      <tr>
        @if (count($armateurs) > 0)
          <th>Armateurs: &nbsp;</th>
          <th colspan="3">
            <ul class="listed">
              @foreach ($armateurs as $armateur)
                <li>{{ $armateur->nom . ' ' . $armateur->prenom }}</li>
              @endforeach
            </ul>
          </th>
        @else
        <th>Armateurs: &nbsp;</th>
        <td>0 Armateurs</td>
        @endif
      </tr>
    </tbody>
  </table>
  <table class="grid half">
    <tbody class="t-body">
      <tr>
        <th>Matricule: &nbsp;</th>
        <td>{{ $navire->matricule }}</td>
      </tr>
      <tr>
        <th>Portattache: &nbsp;</th>
        <td>{{ $navire->portattache }}</td>
      </tr>
      <tr>
        <th>Type: &nbsp;</th>
        <td>{{ $navire->type }}</td>
      </tr>
      <tr>
        <th>Type Dem: &nbsp;</th>
        <td>{{ $navire->type_dem }}</td>
      </tr>
      <tr>
        <th>Quartier Maritime: &nbsp;</th>
        <td>{{ $navire->quartier_maritime }}</td>
      </tr>
      <tr>
        <th></th>
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
