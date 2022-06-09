@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title',' Navire ')

@section('content')
<form id='update' class="container" method='POST' action='/navires/{{ $navire->id }}'>
  @method('PUT')
  @csrf
  <div class="form d-flex">
    <div class="width-100">
    @if (Session::get('success'))
    <div class="result success">
      {{ Session::get('success') }}
    </div>
    @elseif (Session::get('fail'))
    <div class="result fail">
      {{ Session::get('fail') }}
    </div>
    @else
    <p>All fields marked with an asterisk * are required</p>
    @endif
  </div>
<div class="width-50">
    <label for="matricule">matricule *</label>
    <input type="text" id="matricule" name='matricule' value="{{ $navire->matricule }}" />
    <span class="error">@error('matricule') {{ $message }} @enderror</span>

    <label for="nom" dir="auto">nom *</label>
    <input type="text" id="nom" name='nom' value="{{ $navire->nom }}" />
    <span class="error">@error('nom') {{ $message }} @enderror</span>

    <label for="email">email *</label>
    <input type="email" id="email" name='email' value="{{ $navire->email }}" />
    <span class="error">@error('email') {{ $message }} @enderror</span>

    <label for="portattache" dir="auto">portattache *</label>
    <input type="text" id="portattache" name='portattache' value="{{ $navire->portattache }}" />
    <span class="error">@error('portattache') {{ $message }} @enderror</span>

    <label for="categorie" dir="auto">categorie *</label>
    <input type="text" id="categorie" name='categorie' value="{{ $navire->categorie }}" />
    <span class="error">@error('categorie') {{ $message }} @enderror</span>

    <label for="scategorie" dir="auto">scategorie *</label>
    <input type="text" id="scategorie" name='scategorie' value="{{ $navire->scategorie }}" />
    <span class="error">@error('scategorie') {{ $message }} @enderror</span>
  </div>
  <div class="width-50">
    <label for="type" dir="auto">type *</label>
    <input type="text" id="type" name='type' value="{{ $navire->type }}" />
    <span class="error">@error('type') {{ $message }} @enderror</span>

    <label for="type_dem" dir="auto">type dem *</label>
    <input type="text" id="type_dem" name='type_dem' value="{{ $navire->type_dem }}" />
    <span class="error">@error('type_dem') {{ $message }} @enderror</span>

    <label for="date_immatriculation" dir="auto">date immatriculation *</label>
    <input type="date" id="date_immatriculation" name='date_immatriculation' value="{{ $navire->date_immatriculation }}" />
    <span class="error">@error('date_immatriculation') {{ $message }} @enderror</span>

    <label for="quartier_maritime" dir="auto">quartier maritime *</label>
    <input type="date" id="quartier_maritime" name='quartier_maritime' value="{{ $navire->quartier_maritime }}" />
    <span class="error">@error('quartier_maritime') {{ $message }} @enderror</span>
  </div>
  </div>
</form>
<form id='delete' method="POST" action="/navires/{{ $navire->id }}">
  @csrf
  @method('DELETE')
</form>
<div class="buttons">
  {{-- <input type="submit" value="Update" form="update" /> --}}
  <button type="submit" form="update"><i class="fa fa-pencil"></i> Update</button>
  <a class='delete'><i class="fa fa-trash"></i> Delete</a>
  <a class="cancel" href="/navires"><i class="fa fa-ban"></i> Cancel</a>
</div>
@endsection
@section('scripts')
<script>
  $('.delete').click(function () {
    let sure = confirm('Are You sure about that');
    if (sure) {
      $('#delete').submit();
    }
  });
</script>
@endsection
