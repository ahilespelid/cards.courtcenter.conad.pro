@extends('layouts.app')

@section('title', 'Медиации')
@section('description', 'Медиации')

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
                        <textarea rows="1" cols="66" id="{{ $key }}" name="{{ $key }}">{{ $val['data'] ?? '' }}</textarea>
                    @elseif(isset($val['type']) && 'i' == $val['type'])
                        <input type="number" id="{{ $key }}" name="{{ $key }}" value="{{ $val['data'] ?? '' }}">
                    @elseif(isset($val['type']) && 'd' == $val['type'])
                        <input type="text" disabled value="{{ $val['data'] ?? '' }}"><br>
                        <input type="text" id="{{ $key }}" name="{{ $key }}" value="" class="date">
                    @elseif(isset($val['type']) && 'o' == $val['type'])
                        <select size="1" name="{{ $key }}">
                            <option disabled>Выберите тип</option>
                            @foreach($val['data'] as $k => $v)
                            <option value="{{ $v['id'] ?? '' }}" @if($v['id'] == $val['selected']) selected @endif>{{ $v['option'] }}</option>
                            @endforeach
                        </select>                    
                    @elseif(isset($val['type']) && 'm' == $val['type'][0])
                        <textarea readonly disabled rows="1" cols="66" id="{{ $key }}" name="{{ $key }}">{{ $val['data']['data'] ?? '' }}</textarea>
                        <br>
                        @if(isset($val['type'][1]) && 'd' == $val['type'][1])
                        <input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $val['data'] ?? '' }}" class="date">
                        @else
                        <textarea rows="1" cols="66" id="{{ $key }}" name="{{ $key }}">{{ $val['data']['data'] ?? '' }}</textarea> 
                        @endif 
                        </td><td>
                        <label for="{{ $key }}">{{ $val['data']['updated_at'] ?? '' }}</label>                   
                    @else
                        <input type="text" id="{{ $key }}" name="{{ $key }}" value="{{ $val['data'] ?? '' }}">
                    @endif
                    </td>
                </tr>
@endforeach
            </table>
        </div>
        <div class="footer"><a href="{{ route('front.up', ['deal_into_id' => $deal_into_id]) }}" class="button">Выгрузить</a><button type="submit" type="button" class="button">Сохранить</button></div>
    </form>
</div>    
@endsection