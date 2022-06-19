@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title','Navire')

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
    <p>Tous les champs marqués d'un astérisque * sont obligatoires</p>
    @endif
  </div>
  <div class="width-50">
    <label for="matricule">Matricule *</label>
    <input type="text" id="matricule" name='matricule' value="{{ $navire->matricule }}" />
    <span class="error">@error('matricule') {{ $message }} @enderror</span>

    <label for="nom" dir="auto">Nom *</label>
    <input type="text" id="nom" name='nom' value="{{ $navire->nom }}" />
    <span class="error">@error('nom') {{ $message }} @enderror</span>

    <label for="portattache" dir="auto">Portattache *</label>
    <input type="text" id="portattache" name='portattache' value="{{ $navire->portattache }}" />
    <span class="error">@error('portattache') {{ $message }} @enderror</span>

    <label for="categorie" dir="auto">Categorie *</label>
    <input type="text" id="categorie" name='categorie' value="{{ $navire->categorie }}" />
    <span class="error">@error('categorie') {{ $message }} @enderror</span>

    <label for="scategorie" dir="auto">SCategorie *</label>
    <input type="text" id="scategorie" name='scategorie' value="{{ $navire->scategorie }}" />
    <span class="error">@error('scategorie') {{ $message }} @enderror</span>
  </div>
  <div class="width-50">
    <label for="armateur_id" dir="auto">Armateur *</label>
    <select id="armateur_id" name='armateur_id'>
      @foreach ($armateurs as $armateur)
        <option value="{{ $armateur->id }}">{{ $armateur->nom . ' ' . $armateur->prenom }}</option>
      @endforeach
    </select>
    <span class="error">@error('armateur_id') {{ $message }} @enderror</span>

    <label for="type" dir="auto">Type *</label>
    <input type="text" id="type" name='type' value="{{ $navire->type }}" />
    <span class="error">@error('type') {{ $message }} @enderror</span>

    <label for="type_dem" dir="auto">Type Dem *</label>
    <input type="text" id="type_dem" name='type_dem' value="{{ $navire->type_dem }}" />
    <span class="error">@error('type_dem') {{ $message }} @enderror</span>

    <label for="date_immatriculation" dir="auto">Date Immatriculation *</label>
    <input type="date" id="date_immatriculation" name='date_immatriculation' value="{{ $navire->date_immatriculation }}" />
    <span class="error">@error('date_immatriculation') {{ $message }} @enderror</span>

    <label for="quartier_maritime" dir="auto">Quartier Maritime *</label>
    <input type="text" id="quartier_maritime" name='quartier_maritime' value="{{ $navire->quartier_maritime }}" />
    <span class="error">@error('quartier_maritime') {{ $message }} @enderror</span>
  </div>
  </div>
</form>
<form id='delete' method="POST" action="/navires/{{ $navire->id }}">
  @csrf
  @method('DELETE')
</form>
<div class="buttons">
  <button type="submit" form="update"><i class="fa fa-pencil"></i>&nbsp; Mettre à jour</button>
  <a class="cancel" href="/navires"><i class="fa fa-ban"></i>&nbsp; Annuler</a>
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
