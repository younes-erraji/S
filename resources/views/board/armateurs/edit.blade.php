@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title','Armateur')

@section('content')
<form id='update' class="container" method='POST' action='/armateurs/{{ $armateur->id }}'>
  @method("PUT")
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
  <div class="width-100">
    <label for="identite">Identite *</label>
    <input type="text" id="identite" name='identite' value="{{ $armateur->identite }}" />
    <span class="error">@error('identite') {{ $message }} @enderror</span>

    <label for="nom">Nom *</label>
    <input type="text" id="nom" name='nom' value="{{ $armateur->nom }}" />
    <span class="error">@error('nom') {{ $message }} @enderror</span>

    <label for="prenom">Prenom *</label>
    <input type="text" id="prenom" name='prenom' value="{{ $armateur->prenom }}" />
    <span class="error">@error('prenom') {{ $message }} @enderror</span>

    <label for="email">Adresse e-maile *</label>
    <input type="email" id="email" name='email' value="{{ $armateur->email }}" />
    <span class="error">@error('email') {{ $message }} @enderror</span>

    <label for="type">type *</label>
    <input type="text" id="type" name='type' value="{{ $armateur->type }}" />
    <span class="error">@error('type') {{ $message }} @enderror</span>

    <label for="nom_court">nom court *</label>
    <input type="text" id="nom_court" name='nom_court' value="{{ $armateur->nom_court }}" />
    <span class="error">@error('nom_court') {{ $message }} @enderror</span>
  </div>

  <div class="buttons width-100">
    <button type="submit"><i class="fa fa-pencil"></i> Mettre à jour</button>
    <a class="cancel" href="/armateurs"><i class="fa fa-ban"></i> Annuler</a>
  </div>
  </div>
</form>

@endsection
@section('scripts')
@endsection
