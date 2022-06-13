@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title','Armateur')

@section('content')
<form id='insert' class="container" method='POST' action='/armateurs'>
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
  <div class="width-100">

    <label for="identite">Identite *</label>
    <input type="text" id="identite" name='identite' value="{{ old('identite') }}" />
    <span class="error">@error('identite') {{ $message }} @enderror</span>

    <label for="nom" dir="auto">Nom *</label>
    <input type="text" id="nom" name='nom' value="{{ old('nom') }}" />
    <span class="error">@error('nom') {{ $message }} @enderror</span>

    <label for="prenom" dir="auto">Prenom *</label>
    <input type="text" id="prenom" name='prenom' value="{{ old('prenom') }}" />
    <span class="error">@error('prenom') {{ $message }} @enderror</span>

    <label for="email">E-mail addresse *</label>
    <input type="email" id="email" name='email' value="{{ old('email') }}" />
    <span class="error">@error('email') {{ $message }} @enderror</span>

    <label for="type" dir="auto">Type *</label>
    <input type="text" id="type" name='type' value="{{ old('type') }}" />
    <span class="error">@error('type') {{ $message }} @enderror</span>

    <label for="nom_court" dir="auto">Nom Court *</label>
    <input type="text" id="nom_court" name='nom_court' value="{{ old('nom_court') }}" />
    <span class="error">@error('nom_court') {{ $message }} @enderror</span>
  </div>

  <div class="buttons width-100">
    <button type="submit"><i class="fa fa-pencil"></i> Insert</button>
    <a class="cancel" href="/armateurs"><i class="fa fa-ban"></i> Cancel</a>
  </div>
  </div>
</form>

@endsection
@section('scripts')
@endsection
