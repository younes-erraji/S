@extends('layouts.board')
@section('style')
<link rel='stylesheet' href="{{ asset('assets/styles/board/show.css') }}" />
@endsection

@section('title','Doublon')

@section('content')

<div class="container">
  <table class="grid">
    <tbody class="two-column">
      <tr>
        <th>#</th>
        <td>{{ $double->id }}</td>

        <th>Table:</th>
        <td>{{ $double->table }}</td>
      </tr>
      <tr>
        <th>Matricule</th>
        <td>{{ $double->matricule }}</td>

        <th>Nom</th>
        <td>{{ $double->nom }}</td>
      </tr>
      {{-- <tr>
        <th>Categorie</th>
        <td>{{ $double->categorie }}</td>

        <th>Type</th>
        <td>{{ $double->type }}</td>
      </tr>
      <tr>
        <th>SCategorie</th>
        <td>{{ $double->scategorie }}</td>

        <th>Type Dem</th>
        <td>{{ $double->type_dem }}</td>
      </tr>
      <tr>
        <th>Date Immatriculation</th>
        <td>{{ $double->date_immatriculation }}</td>

        <th>Quartier Maritime</th>
        <td>{{ $double->quartier_maritime }}</td>
      </tr> --}}
      <tr>

        <th class='actions'>
          <a class="action edit" href="/doubles/{{ $double->id }}/edit"><i class="fa fa-pencil"></i></a>
          <form method="POST" action="/doubles/{{ $double->id }}">
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
