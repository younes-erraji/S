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

    {{--
    <form class="d-flex" method='POST' action="/doubles/armateurs/import" enctype="multipart/form-data">
      @csrf
      <div>
        <input type="file" id='armateurs' name="armateurs" />
        <span class="error">@error('armateurs') {{ $message }} @enderror</span>
      </div>
      <button class="button import"><i class="fa fa-upload"></i> Import</button>
    </form>
    --}}

    <div class="dataTables_filter d-flex" style="justify-content: flex-end">
      <label for='selected-armateur' style="color:#333">Armateurs: </label>
      <select id='selected-armateur' name="selected-armateur"
        style="width: 180px;
          border: 1px solid #aaa;
          border-radius: 3px;
          padding: 5px;
          background-color: transparent;
          margin-left: 3px;">
          <option selected disabled hidden>Armateur</option>
          @foreach ($armateurs as $armateur)
            <option value="{{ $armateur->identite }}">{{ $armateur->prenom . ' ' . $armateur->nom }}</option>
          @endforeach
      </select>
    </div>
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>CIN</th>
        <th>Nom</th>
        <th>E-mail</th>
        <th>Type</th>
        {{-- <th>Count</th> --}}
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody id='doubles-body'>
      @foreach ($d_armateurs as $d_armateur)
      <tr>
        <td>{{ $d_armateur->id }}</td>
        <td>{{ $d_armateur->identite }}</td>
        <td>{{ $d_armateur->nom . ' ' . $d_armateur->prenom }}</td>
        <td>{{ $d_armateur->email }}</td>
        <td>{{ $d_armateur->type }}</td>
        {{-- <td>{{ $d_armateur->count }}</td> --}}
        <td><a class="edit" href="/doubles/armateurs/show/{{ $d_armateur->id }}"><i class="fa fa-info"></i></a></td>

        <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/armateurs/comparer/{{ $d_armateur->id }}">Comparer</a></td>

        <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/armateurs/fusionner/{{ $d_armateur->id }}">Fusionner</a></td>

        <td>
          <form method="POST" action="/doubles/armateurs/{{ $d_armateur->id }}">
            @csrf
            @method('DELETE')
            <a class="delete"><i class="fa fa-trash-o"></i></a>
          </form>
        </td>
        <td>
          <form method="POST" action="/doubles/armateurs/delete-all/{{ $d_armateur->id }}">
            @csrf
            <a class="delete" style='width: auto; font-size: 14px'>Supprimer Tout</a>
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
    ordering: false,
    language: {
      url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
    }
  });

  const selectedArmateur = document.querySelector('#selected-armateur');

  $(document).on('click', 'a.delete', function (e) {
    let sure = confirm('Are You sure about that');
      if (sure) {
        e.target.parentElement.submit();
      }
  });

  const token  = $('meta[name="csrf-token"]').attr('content'),
    url = '{{ route("getArmateurDoubles") }}',
    doublesBody = $('#doubles-body');

    selectedArmateur.onchange = (e) => {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': token
        },
        url: url,
        method: 'POST',
        data: {
          code: e.target.value,
        },
        dataType: 'json',
        success: function (data) {
          doublesBody.empty();
          if (data.code == 1) {
            for (let i = 0; i < data.d_armateurs.length; i++) {
              doublesBody.append(`<tr>
                <td>${data.d_armateurs[i].id}</td>
                <td>${data.d_armateurs[i].identite}</td>
                <td>${data.d_armateurs[i].nom + ' ' + data.d_armateurs[i].prenom}</td>
                <td>${data.d_armateurs[i].email}</td>
                <td>${data.d_armateurs[i].type}</td>
                <td>${data.d_armateurs[i].count}</td>
                <td><a class="edit" href="/doubles/armateurs/show/${data.d_armateurs[i].id}"><i class="fa fa-info"></i></a></td>
                <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/armateurs/fusionner/${data.d_armateurs[i].id}">Fusionner</a></td>
                <td>
                  <form method="POST" action="/doubles/armateurs/${data.d_armateurs[i].id}">
                    @csrf
                    @method('DELETE')
                    <a class="delete"><i class="fa fa-trash-o"></i></a>
                  </form>
                </td>
              </tr>`);
            }

          } else {
            doublesBody.append('<tr class="odd"><td colspan="9" class="dataTables_empty" valign="top">No data available in table</td></tr>')
          }

        }
      });
    }
</script>
@endsection
