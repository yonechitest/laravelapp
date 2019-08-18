@extends('layouts.helloapp')

@section('title', '削除画面')

@section('menubar')
    @parent
    削除ページ
@endsection

@section('content')
	<a href="{{ action('AppMainController@show') }}" >もどる</a>
    <table>
    <form action="/person/del" method="post">
       {{ csrf_field() }}
       <input type="hidden" name="id" value="{{$form->id}}">
       <tr><th>name: </th><td>{{$form->name}}</td></tr>
       <tr><th>mail: </th><td>{{$form->mail}}</td></tr>
       <tr><th>age: </th><td>{{$form->age}}</td></tr>
       <tr><th></th><td><input type="submit" value="削除"></td></tr>
    </form>
    </table>
@endsection

@section('footer')
copyright 2019 yonetani.
@endsection
