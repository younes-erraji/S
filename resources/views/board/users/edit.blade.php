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
    <p>All fields marked with an asterisk * are required</p>
    @endif

    <label for="name">name</label>
    <input type="text" id="name" name="name" value="{{ $user->name }}" />
    <span class="error">@error('name') {{ $message }} @enderror</span>

    <label for="email">email</label>
    <input type="email" id="email" name="email" value="{{ $user->email }}" />
    <span class="error">@error('email') {{ $message }} @enderror</span>

    <label for="password">password</label>
    <input type="password" id="password" name="password" />
    <span class="error">@error('password') {{ $message }} @enderror</span>

    <label for="password_confirmation">password confirmation</label>
    <input type="password" id="password_confirmation" name="password_confirmation" />
    <span class="error">@error('password_confirmation') {{ $message }} @enderror</span>

    <label for="user_role">user role *</label>
    <select name="user_role" id="user_role">
      <option selected disabled>Choose...</option>
      <option value="user">user</option>
      <option value="administrator">administrator</option>
    </select>
    <span class="error">@error('user_role') {{ $message }} @enderror</span>

  </div>
</form>
<div class="buttons">
  {{-- <input type="submit" value="Update" form="update-form" /> --}}
  <button type="submit" form="update-form"><i class="fa fa-pencil"></i> Update</button>
  <a class="cancel" href="/users"><i class="fa fa-ban"></i> Cancel</a>
</div>
@endsection
