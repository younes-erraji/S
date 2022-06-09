@extends('layouts.board')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/styles/board/CRUD.css') }}" />
@endsection

@section('title',' Operation ')

@section('content')
<form id='update' class="container" method='POST' action='/operations/{{ $operation->id }}'>
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
    <label for="type">type *</label>
    <input type="text" id="type" name='type' value="{{ $operation->type }}" />
    <span class="error">@error('type') {{ $message }} @enderror</span>

    <label for="operation_date" dir="auto">operation_date *</label>
    <input type="date" id="operation_date" name='operation_date' value="{{ $operation->operation_date }}" />
    <span class="error">@error('operation_date') {{ $message }} @enderror</span>
  </div>

  <div class="buttons width-100">
    <button type="submit"><i class="fa fa-pencil"></i> Update</button>
    <a class="cancel" href="/operations"><i class="fa fa-ban"></i> Cancel</a>
  </div>
  </div>
</form>

@endsection
@section('scripts')
@endsection
