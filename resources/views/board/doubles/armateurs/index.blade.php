@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/datatable.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/table.css') }}" />
<style>
.grid {
  font-size: 14px;
}
</style>
@endsection

@section('title','Doublons des Armateurs')

@section('content')
<div class="container">
  @if (Session::get('success'))
  <div class="result success">
    {{ Session::get('success') }}
  </div>
  @elseif (Session::get('fail'))
  <div class="result fail">
    {{ Session::get('fail') }}
  </div>
  @endif

  <div class="buttons">
    <a href="/doubles/armateurs/export" @if(count($d_armateurs) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Export</a>

    <form class="d-flex" method='POST' action="/doubles/armateurs/import" enctype="multipart/form-data">
      @csrf
      <div>
        <input type="file" id='armateurs' name="armateurs" />
        <span class="error">@error('armateurs') {{ $message }} @enderror</span>
      </div>
      <button class="button import"><i class="fa fa-upload"></i> Import</button>
    </form>
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>CIN</th>
        <th>Nom</th>
        <th>E-mail</th>
        <th>Type</th>
        <th>Count</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($d_armateurs as $d_armateur)
      <tr>
        <td>{{ $d_armateur->id }}</td>
        <td>{{ $d_armateur->identite }}</td>
        <td>{{ $d_armateur->nom . ' ' . $d_armateur->prenom . '(' . $d_armateur->nom_court . ')' }}</td>
        <td>{{ $d_armateur->email }}</td>
        <td>{{ $d_armateur->type }}</td>
        <td>{{ $d_armateur->count }}</td>
        <td><a class="edit" href="/doubles/armateurs/show/{{ $d_armateur->id }}"><i class="fa fa-info"></i></a></td>
        <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/armateurs/fusionner/{{ $d_armateur->id }}">Fusionner</a></td>
        <td>
          <form method="POST" action="/doubles/armateurs/{{ $d_armateur->id }}">
            @csrf
            @method('DELETE')
            <a class="delete"><i class="fa fa-trash-o"></i></a>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/scripts/board/datatable.js') }}"></script>
<script>
  $('.grid').DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
    }
  });
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
