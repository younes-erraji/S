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
        <th>Identite: </th>
        <td>{{ $armateur->identite }}</td>
      </tr>
      <tr>
        <th>Nom: </th>
        <td>{{ $armateur->nom . ' ' . $armateur->prenom }}</td>
      </tr>
      <tr>
        <th>Nom Court: </th>
        <td>{{ $armateur->nom_court }}</td>
      </tr>
      <tr>
        <th>E-mail: </th>
        <td>{{ $armateur->email }}</td>
      </tr>
      <tr>
        <th>Type: </th>
        <td>{{ $armateur->type }}</td>
      </tr>
      @if (count($navires) > 0)
      <tr>
        <th>Navires: </th>
        <td>
          <ul class="listed">
            @foreach($navires as $navire)
            <li>{{ $navire->nom }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      @else
      <tr>
        <td colspan="2">Cet Armateur n'a pas de navires</td>
      </tr>
      @endif
      <tr>
        <th></th>
        <td class='actions'>
          <a class="action edit" href="/armateurs/{{ $armateur->id }}/edit"><i class="fa fa-pencil"></i></a>
          <form method="POST" action="/armateurs/{{ $armateur->id }}">
            @csrf
            @method('DELETE')
            <a class="action delete"><i class="fa fa-trash-o"></i></a>
          </form>
        </td>
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
