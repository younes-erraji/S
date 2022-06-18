@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title','Operation')

@section('content')
<form id='insert' class="container" method='POST' action='/operations'>
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
    <label for="type">Type *</label>
    <input type="text" id="type" name='type' value="{{ old('type') }}" />
    <span class="error">@error('type') {{ $message }} @enderror</span>

    <label for="operation_date" dir="auto">Date d'opération *</label>
    <input type="date" id="operation_date" name='operation_date' value="{{ old('operation_date') }}" />
    <span class="error">@error('operation_date') {{ $message }} @enderror</span>

    <label for="navire_id" dir="auto">Navire *</label>
    <select id="navire_id" name='navire_id'>
      @foreach ($navires as $navire)
        <option value="{{ $navire->id }}">{{ $navire->nom }}</option>
      @endforeach
    </select>
    <span class="error">@error('armateur_id') {{ $message }} @enderror</span>
  </div>

  <div class="buttons width-100">
    <button type="submit"><i class="fa fa-pencil"></i> Insérer</button>
    <a class="cancel" href="/operations"><i class="fa fa-ban"></i> Annuler</a>
  </div>
  </div>
</form>

@endsection
@section('scripts')
@endsection
