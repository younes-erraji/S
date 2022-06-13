@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title','User')

@section('content')
<form id='insert-form' class="container" method='POST' action='/users' enctype="multipart/form-data">
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
    <p>All fields marked with an asterisk * are required</p>
    @endif

    <label for="name">Nom</label>
    <input type="text" id="name" name="name" value="{{ old("name") }}" />
    <span class="error">@error('name') {{ $message }} @enderror</span>

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" value="{{ old("email") }}" />
    <span class="error">@error('email') {{ $message }} @enderror</span>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" value="{{ old("password") }}" />
    <span class="error">@error('password') {{ $message }} @enderror</span>

    <label for="password_confirmation">Password confirmation</label>
    <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old("password_confirmation") }}" />
    <span class="error">@error('password_confirmation') {{ $message }} @enderror</span>

    <label for="user_role">Role *</label>
    <select name="user_role" id="user_role">
      <option selected disabled>Choose...</option>
      <option value="user">User</option>
      <option value="administrator">Administrator</option>
    </select>
    <span class="error">@error('user_role') {{ $message }} @enderror</span>
    <div class="buttons">
      <button type="submit"><i class="fa fa-pencil"></i> Insert</button>
      <a class="cancel" href="/users"><i class="fa fa-ban"></i> Cancel</a>
    </div>
  </div>
</form>

@endsection
