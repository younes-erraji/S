@extends('layouts.board')
@section('style')
<link rel='stylesheet' href="{{ asset('assets/styles/board/show.css') }}" />
@endsection

@section('title','Armateur')

@section('content')

<div class="container">
  <table class="grid">
    <tbody class="one-column">
      <tr>
        <th>#</th>
        <td>{{ $d_armateur->id }}</td>
      </tr>
      <tr>
        <th>Identite</th>
        <td>{{ $d_armateur->identite }}</td>
      </tr>
      <tr>
        <th>Nom</th>
        <td>{{ $d_armateur->nom . ' ' . $d_armateur->prenom }}</td>
      </tr>
      <tr>
        <th>Nom Court</th>
        <td>{{ $d_armateur->nom_court }}</td>
      </tr>
      <tr>
        <th>E-mail</th>
        <td>{{ $d_armateur->email }}</td>
      </tr>
      <tr>
        <th>Type</th>
        <td>{{ $d_armateur->type }}</td>
      </tr>
      <tr>
        <th></th>
        <th class='actions'>
          <form method="POST" action="/armateurs/{{ $d_armateur->id }}">
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
