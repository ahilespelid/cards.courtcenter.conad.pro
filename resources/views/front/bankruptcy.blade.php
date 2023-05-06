@extends('layouts.app')

@section('title', 'Суд первой инстанции')
@section('description', 'Суд первой инстанции')

@section('content')
        <form action="/" method="post">
            <table>
                <tr>
                    <td><label for="name">Название сделки, внутренний номер</label></td>
                    <td><input type="text" id="name" name="name"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="storoni">Стороны по делу</label></td>
                    <td><input type="text" id="storoni" name="storoni"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="strategi">Стратегия</label></td>
                    <td><input type="text" id="strategi" name="strategi" placeholder="Стратегия"></td>
                    <td><span>11.04.2023</span></td>
                </tr>
                <tr>
                    <td><label for="undefine"></label></td>
                    <td><input type="hidden" name="_token" value="{{ csrf_token() }}" /></td>
                    <td><span></span></td>
                </tr>
        
            </table>
            <div class="footer"><a href="#submit" class="button">Выгрузить</a><button type="submit" type="button" class="button">Сохранить</button></div>
        </form>
    
@endsection