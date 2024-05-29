@extends('front.app')

@section('title', 'Суд первой инстанции')
@section('description', 'Суд первой инстанции')

@section('content')
<div class="form">
    <form action="/save" method="post">
        <div>
            <table>
                <tr>
                <td><label for="deal_into_id">Внутренний номер : </label></td>
                <td> <h1 id="deal_id">{{ $deal_id ?? '' }}</h1>
                    <input type="hidden" name="deal_id" value="{{ $deal_id ?? '' }}">
                    <input type="hidden" name="instance" value="{{ $instance ?? '' }}">
                </td></tr>      
@foreach($data as $k => $d)
                <tr>
                    <td><label for="{{ $k }}">{{ $d['title'] ?? '' }} : </label></td>
                    <td>
                    @if('STAGE' == $k) <input id="STAGE" name="{{ $k }}" type="hidden" value="{{ $d['bitrix'][0] ?? '' }}"><span>{{ $d['bitrix'][0] ?? '' }}</span> @php continue; @endphp @endif
                    @if('string' == $d['type'])
                        <textarea rows="1" cols="66" id="{{ $k }}" name="{{ $k }}">{{ $d['bitrix'][0] ?? '' }}</textarea>
                @elseif('integer' == $d['type'])
                        <input type="number" id="{{ $k }}" name="{{ $k }}" value="{{ $d['bitrix'][0] ?? '' }}">
                @elseif('date' == $d['type'])
                        <input type="text" disabled value="{{ $d['bitrix'][0] ?? '' }}"><br>
                        <input type="text" id="{{ $k }}" name="{{ $k }}" value="{{ $d['bitrix'][0] ?? '' }}" class="date">
                @elseif('select' == $d['type'])
                        <select size="1" name="{{ $k }}">
                            <option disabled>Выберите вариант</option>
                            @foreach($d['bitrix'] as $v)
                            <option value="{{ $v['value'] ?? '' }}" @if(1 == $v['selected']) selected @endif>{{ $v['title'] ?? '' }}</option>
                            @endforeach
                        </select>                    
                
                @elseif(in_array($d['type'], ['mstring','mdate','hstring']))
                        <select size="1" name="history_{{ $k }}">
                            <option disabled selected>История изменений</option>
                     @if(is_array($d['history'])) 
                     @foreach($d['history'] as $h)
                        @if(empty($h['value'][0])) @php continue; @endphp @endif
                            <option disabled>{{ date('Y d M в H:i', strtotime($h['created_at'] ?? 'now')) ?? '' }} - <b>{{ $h['value'][0] ?? '' }}</b></option>
                     @endforeach
                     @else
                            <option disabled>{{ $d['value'][0] ?? '' }}</option>
                     @endif
                        </select> @php //pa($d); @endphp                   
                     
                     {{--   <textarea readonly disabled rows="1" cols="66" id="{{ $k }}" name="{{ $k }}">{{ $d['bitrix'][0] ?? '' }}</textarea><br>    --}}
                     {{--   <label for="{{ $k }}">{{ $d['bitrix']['updated_at'] ?? '' }}</label>    --}}
                        
                        @if('d' == $d['type'][1])
                        <input type="text" id="{{ $k }}" name="{{ $k }}" value="{{ $d['bitrix'][0] ?? '' }}" class="date">
                        @else
                        <textarea rows="1" cols="66" id="{{ $k }}" name="{{ $k }}">{{ $d['bitrix'][0] ?? '' }}</textarea> 
                        @endif 
                        </td><td>
                                           
                    @else
                        <input type="text" id="{{ $k }}" name="{{ $k }}" value="{{ $d['bitrix'][0] ?? '' }}">
                    @endif
                    </td>
                </tr>
@endforeach
            </table>
        </div>
        <div class="footer"><a href="{{ route('front.report', ['deal_id' => $deal_id, 'instance' => 'index']) }}" class="button" target="_blank">Выгрузить</a><button type="submit" type="button" class="button">Сохранить</button></div>
    </form>
</div>    
@endsection