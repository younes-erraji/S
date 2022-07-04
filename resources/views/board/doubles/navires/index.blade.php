@extends('layouts.board')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/datatable.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/styles/board/table.css') }}" />
<style>
.grid {
  font-size: 14px;
}
</style>
@endsection

@section('title','Doublons des Navires')

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
    <a href="/doubles/navires/export" @if(count($d_navires) === 0) disabled @endif class="button excel"><i class="fa fa-download"></i> Export</a>

    {{--
    <form class="d-flex" method='POST' action="/doubles/navires/import" enctype="multipart/form-data">
      @csrf
      <div>
        <input type="file" id='navires' name="navires" />
        <span class="error">@error('navires') {{ $message }} @enderror</span>
      </div>
      <button class="button import"><i class="fa fa-upload"></i> Import</button>
    </form>
    --}}

    <div class="dataTables_filter d-flex" style="justify-content: flex-end">
      <label for='selected-navire' style="color:#333">Navires: </label>
      <select id='selected-navire' name="selected-navire"
        style="width: 180px;
          border: 1px solid #aaa;
          border-radius: 3px;
          padding: 5px;
          background-color: transparent;
          margin-left: 3px;">
          <option selected disabled hidden>Navire</option>
          @foreach ($navires as $navire)
            <option value="{{ $navire->matricule }}">{{ $navire->matricule }}</option>
          @endforeach
      </select>
    </div>
  </div>

  <table class="grid">
    <thead>
      <tr>
        <th>#</th>
        <th>Matricule</th>
        <th>Nom</th>
        <th>Armateur</th>
        <th>Count</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody id='doubles-body'>
      @foreach ($d_navires as $d_navire)
      <tr>
        <td>{{ $d_navire->id }}</td>

        <td>{{ $d_navire->matricule }}</td>
        <td>{{ $d_navire->nom }}</td>
        <td>{{ $d_navire->armateur }}</td>

        <td>{{ $d_navire->count }}</td>
        <td><a class="edit" href="/doubles/navires/show/{{ $d_navire->id }}"><i class="fa fa-info"></i></a></td>
        <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/navires/comparer/{{ $d_navire->id }}">Comparer</a></td>
        <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/navires/fusionner/{{ $d_navire->id }}">Fusionner</a></td>
        <td>
          <form method="POST" action="/doubles/navires/{{ $d_navire->id }}">
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
    ordering: false,
    language: {
      url: 'https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json'
    }
  });
  const // deleteButtons = Array.from(document.querySelectorAll('a.delete')),
    selectedNavire = document.querySelector('#selected-navire');
  // deleteButtons.forEach(function (item) {
  //   item.addEventListener('click', () => {
  //     let sure = confirm('Are You sure about that');
  //     if (sure) {
  //       item.parentElement.submit();
  //     }
  //   });
  // });

  $(document).on('click', 'a.delete', function (e) {
    let sure = confirm('Are You sure about that');
      if (sure) {
        e.target.parentElement.submit();
      }
  });

  const token  = $('meta[name="csrf-token"]').attr('content'),
    url = '{{ route("getNavireDoubles") }}',
    doublesBody = $('#doubles-body');

  selectedNavire.onchange = (e) => {
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
          for (let i = 0; i < data.d_navires.length; i++) {
            doublesBody.append(`<tr>
              <td>${data.d_navires[i].id}</td>

              <td>${data.d_navires[i].matricule}</td>
              <td>${data.d_navires[i].nom}</td>
              <td>${data.d_navires[i].armateur}</td>

              <td>${data.d_navires[i].count}</td>
              <td><a class="edit" href="/doubles/navires/show/${data.d_navires[i].id}"><i class="fa fa-info"></i></a></td>
              <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/navires/comparer/${data.d_navires[i].id}">Comparer</a></td>
              <td><a style='width: auto; font-size: 14px' class="edit" href="/doubles/navires/fusionner/${data.d_navires[i].id}">Fusionner</a></td>
              <td>
                <form method="POST" action="/doubles/navires/${data.d_navires[i].id}">
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
