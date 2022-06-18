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

@section('title','Doubles')

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
    <a href="{{ route('export.doubles.excel') }}" @if(count($doubles) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Excel</a>
    {{-- <a href="{{ route('export.doubles.csv') }}" @if(count($doubles) === 0) disabled @endif class="button csv"><i class="fa fa-download"></i> CSV</a> --}}
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>Matricule</th>
        <th>Nom</th>
        <th>Portattache</th>
        <th>Categorie</th>
        <th>SCategorie</th>
        <th>Type</th>
        <th>Type Dem</th>
        <th>Date Immatriculation</th>
        <th>Quartier Maritime</th>
        <th>Intitule</th>
        <th>Date d'opération</th>
        <th>Créé à</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($doubles as $double)
      <tr>
        <td>{{ $double->id }}</td>
        <td>{{ $double->matricule ?? '---' }}</td>
        <td>{{ $double->nom ?? '---' }}</td>
        <td>{{ $double->portattache ?? '---' }}</td>
        <td>{{ $double->categorie ?? '---' }}</td>
        <td>{{ $double->scategorie ?? '---' }}</td>
        <td>{{ $double->type ?? '---' }}</td>
        <td>{{ $double->type_dem ?? '---' }}</td>
        <td>{{ $double->date_immatriculation ?? '---' }}</td>
        <td>{{ $double->quartier_maritime ?? '---' }}</td>
        <td>{{ $double->intitule ?? '---' }}</td>
        <td>{{ $double->operation_date ?? '---' }}</td>

        <td>{{ $double->created_at }}</td>
        <td>
          <form method="POST" action="doubles/{{ $double->id }}">
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
