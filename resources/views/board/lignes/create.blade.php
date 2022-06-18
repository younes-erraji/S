@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title','Ligne')

@section('content')
<form id='insert' class="container" method='POST' action='/lignes'>
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
    <label for="intitule">Intitule *</label>
    <input type="text" id="intitule" name='intitule' value="{{ old('intitule') }}" />
    <span class="error">@error('intitule') {{ $message }} @enderror</span>
  </div>

  <div class="buttons width-100">
    <button type="submit"><i class="fa fa-pencil"></i> Insérer</button>
    <a class="cancel" href="/lignes"><i class="fa fa-ban"></i> Annuler</a>
  </div>
  </div>
</form>

@endsection
