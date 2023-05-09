@extends('layouts.app')

@section('title', 'Суд касации')
@section('description', 'Суд касации')

@section('content')
<div class="form">
    <form action="/save" method="post">
        <div>
            <table>
                <tr>
                <td><label for="deal_into_id">Внутренний номер : </label></td>
                <td> <h1 id="deal_into_id">{{ $deal_into_id ?? '' }}</h1>
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="hidden" name="tab" value="{{ $_REQUEST['tab'] }}">
                    <input type="hidden" name="deal_id" value="{{ $deal['ID'] ?? '' }}">
                    <input type="hidden" name="deal_into_id" value="{{ $deal_into_id ?? '' }}">
                </td></tr>      
@foreach($data as $key => $val)
                <tr>
                    <td><label for="{{ $key }}">{{ $val['title'] ?? '' }} : </label></td>
                    <td>
                    @if(isset($val['type']) && 's' == $val['type'])
                        <input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $val['data'] ?? '' }}">
                    @elseif(isset($val['type']) && 'i' == $val['type'])
                        <input type="number" id="{{ $key }}" name="{{ $key }}" value="{{ $val['data'] ?? '' }}">
                    @elseif(isset($val['type']) && 'd' == $val['type'])
                        <input type="text" disabled value="{{ $val['data'] ?? '' }}"><br>
                        <input type="text" id="{{ $key }}" name="{{ $key }}" value="" class="date">
                    @elseif(isset($val['type']) && 'o' == $val['type'])
                        <select size="1" name="{{ $key }}">
                            <option disabled>Выберите тип</option>
                            @foreach($val['data'] as $k => $v)
                            <option value="{{ $v['id'] ?? '' }}">{{ $v['option'] }}</option>
                            @endforeach
                        </select>                    
                    @elseif(isset($val['type']) && 'm' == $val['type'])
                        <input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $val['data']['data'] ?? '' }}">
                        </td><td>
                        <label for="{{ $key }}">{{ $val['data']['created_at'] ?? '' }}</label>                   
                    @else
                        <input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $val['data'] ?? '' }}">
                    @endif
                    </td>
                </tr>
@endforeach
            </table>
        </div>
        <div class="footer"><a href="#submit" class="button">Выгрузить</a><button type="submit" type="button" class="button">Сохранить</button></div>
    </form>
</div>    
@endsection