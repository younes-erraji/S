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
        <td>{{ $armateur->id }}</td>
      </tr>
      <tr>
        <th>Identite</th>
        <td>{{ $armateur->identite }}</td>
      </tr>
      <tr>
        <th>Nom</th>
        <td>{{ $armateur->nom . ' ' . $armateur->prenom }}</td>
      </tr>
      <tr>
        <th>Nom Court</th>
        <td>{{ $armateur->nom_court }}</td>
      </tr>
      <tr>
        <th>E-mail</th>
        <td>{{ $armateur->email }}</td>
      </tr>
      <tr>
        <th>Type</th>
        <td>{{ $armateur->type }}</td>
      </tr>
      <tr>
        <th></th>
        <th class='actions'>
          <a class="action edit" href="/armateurs/{{ $armateur->id }}/edit"><i class="fa fa-pencil"></i></a>
          <form method="POST" action="/armateurs/{{ $armateur->id }}">
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
