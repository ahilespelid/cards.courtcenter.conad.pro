@extends('layouts.app')

@section('title', 'Суд первой инстанции')
@section('description', 'Суд первой инстанции')

@section('content')
            <h1>Выберите вкладку</h1>
            <table>
@if(isset($deal))
    @foreach($deal as $key => $val)
        @if(is_string($val))
                <tr>
                    <td><label for="{{ $key }}">{{ $key }} : </label></td>
                    <td><input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $val }}"></td>
                </tr>
        @endif
    @endforeach
@endif
            </table>
                
@endsection