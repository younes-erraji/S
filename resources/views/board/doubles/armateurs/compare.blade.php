@extends('layouts.board')
@section('style')
<link rel='stylesheet' href="{{ asset('assets/styles/board/show.css') }}" />

@endsection

@section('title','Armateur')

@section('content')

<div class="container">
  <div class="subcontainer">
    <table class="grid half">
      <tbody class="t-body">
        <tr>
          <th colspan="2">Armateur</th>
        </tr>
        <tr>
          <th># &nbsp;</th>
          <td>{{ $armateur->id }}</td>
        </tr><tr>
          <th>Identite: &nbsp;</th>
          <td>{{ $armateur->identite }}</td>
        </tr>
        <tr>
          <th>Nom: &nbsp;</th>
          <td>{{ $armateur->nom }}</td>
        </tr><tr>
          <th>Prenom: &nbsp;</th>
          <td>{{ $armateur->prenom }}</td>
        </tr><tr>
          <th>Nom Court: &nbsp;</th>
          <td>{{ $armateur->nom_court }}</td>
        </tr>
        <tr>
          <th>E-mail: &nbsp;</th>
          <td>{{ $armateur->email }}</td>
        </tr><tr>
          <th>Type: &nbsp;</th>
          <td>{{ $armateur->type }}</td>
        </tr>
      </tbody>
    </table>
    <table class="grid half">
      <tbody class="t-body">
        <tr>
          <th colspan="2">Doublon</th>
        </tr>
        <tr>
          <th># &nbsp;</th>
          <td>{{ $d_armateur->id }}</td>
        </tr><tr>
          <th>Identite: &nbsp;</th>
          <td>{{ $d_armateur->identite }}</td>
        </tr>
        <tr>
          <th>Nom: &nbsp;</th>
          <td>{{ $d_armateur->nom }}</td>
        </tr><tr>
          <th>Prenom: &nbsp;</th>
          <td>{{ $d_armateur->prenom }}</td>
        </tr><tr>
          <th>Nom Court: &nbsp;</th>
          <td>{{ $d_armateur->nom_court }}</td>
        </tr>
        <tr>
          <th>E-mail: &nbsp;</th>
          <td>{{ $d_armateur->email }}</td>
        </tr><tr>
          <th>Type: &nbsp;</th>
          <td>{{ $d_armateur->type }}</td>
        </tr>
        <tr>
          <th class='actions'>
            <a style='width: auto;' class="action edit" href="/doubles/armateurs/fusionner/{{ $d_armateur->id }}">Fusionner</a>

            <form method="POST" action="/doubles/armateurs/{{ $d_armateur->id }}">
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
