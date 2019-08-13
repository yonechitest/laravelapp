@extends('layouts.helloapp')

@section('title','TOP画面')

@section('menubar')
    @parent
    TOPページ
@endsection

@section('content')
@section('content')

<a href="{{ action('PersonController@add') }}" >新規作成</a>
<table>
<tr><th>Name</th><th>Mail</th><th>Age</th></tr>
@foreach ($items as $item)
<tr>
<td>{{$item->name}}</td>
<td>{{$item->mail}}</td>
<td>{{$item->age}}</td>
<td><a href="{{ action('PersonController@delete', "id=".$item->id) }}" >削除</td>
<td><a href="{{ action('PersonController@edit', "id=".$item->id) }}" >更新</td>
</tr>
@endforeach
</table>
@endsection

@section('footer')
copyright 2019 yonetani.
@endsection
