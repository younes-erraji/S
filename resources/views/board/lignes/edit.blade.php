@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title',' Ligne ')

@section('content')
<form id='update' class="container" method='POST' action='/lignes/{{ $ligne->id }}'>
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
    <p>All fields marked with an asterisk * are required</p>
    @endif
  </div>
  <div class="width-100">
    <label for="intitule">intitule *</label>
    <input type="text" id="intitule" name='intitule' value="{{ $ligne->intitule }}" />
    <span class="error">@error('intitule') {{ $message }} @enderror</span>
  </div>

  <div class="buttons width-100">
    <button type="submit"><i class="fa fa-pencil"></i> Update</button>
    <a class="cancel" href="/lignes"><i class="fa fa-ban"></i> Cancel</a>
  </div>
  </div>
</form>

@endsection
@section('scripts')
@endsection
