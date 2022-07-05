@extends('layouts.board')
@section('style')
<link rel='stylesheet' href="{{ asset('assets/styles/board/show.css') }}" />
@endsection

@section('title','Armateur')

@section('content')

<div class="container">
  <table class="grid">
    <tbody class="t-body">
      <tr>
        <th># &nbsp;</th>
        <td>{{ $d_armateur->id }}</td>
      </tr>
      <tr>
        <th>Identite: &nbsp;</th>
        <td>{{ $d_armateur->identite }}</td>
      </tr>
      <tr>
        <th>Nom: &nbsp;</th>
        <td>{{ $d_armateur->nom . ' ' . $d_armateur->prenom }}</td>
      </tr>
      <tr>
        <th>Nom Court: &nbsp;</th>
        <td>{{ $d_armateur->nom_court }}</td>
      </tr>
      <tr>
        <th>E-mail: &nbsp;</th>
        <td>{{ $d_armateur->email }}</td>
      </tr>
      <tr>
        <th>Type: &nbsp;</th>
        <td>{{ $d_armateur->type }}</td>
      </tr>
      <tr>
        <th></th>
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
