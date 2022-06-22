@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title','User')

@section('content')
<form id='update-form' class="container" method='POST' action='/users/{{ $user->id }}' enctype="multipart/form-data">
  @method('PUT')
  @csrf
  <div class="form">

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

    <label for="name">Nom</label>
    <input type="text" id="name" name="name" value="{{ $user->name }}" />
    <span class="error">@error('name') {{ $message }} @enderror</span>

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" value="{{ $user->email }}" />
    <span class="error">@error('email') {{ $message }} @enderror</span>

    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" />
    <span class="error">@error('password') {{ $message }} @enderror</span>

    <label for="password_confirmation">Confirmation mot de passe</label>
    <input type="password" id="password_confirmation" name="password_confirmation" />
    <span class="error">@error('password_confirmation') {{ $message }} @enderror</span>

    <label for="user_role">Role *</label>
    <select name="user_role" id="user_role">
      <option value="user">Normal</option>
      <option value="administrator">Administrator</option>
    </select>
    <span class="error">@error('user_role') {{ $message }} @enderror</span>

    <button type="submit"><i class="fa fa-pencil"></i>&nbsp; Mettre à jour</button>
    <a class="cancel" href="/users"><i class="fa fa-ban"></i>&nbsp; Annuler</a>
  </div>
</form>
@endsection
