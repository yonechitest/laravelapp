@extends('layouts.helloapp')

@section('title', '編集画面')

@section('menubar')
    @parent
    編集ページ
@endsection

@section('content')
	<a href="{{ action('PersonController@show') }}" >もどる</a>
    @if (count($errors) > 0)
<p>入力に問題があります。再入力してください。</p>
    @endif
    <table>
    <form action="/person/edit" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$form->id}}">
    @if($errors->has('name'))
		<tr><th>ERROR</th><td>{{$errors->first('name')}}</td></tr>
	@endif
    <tr><th>name: </th><td><input type="text" name="name" value="{{$form->name}}"></td></tr>
    @if($errors->has('mail'))
		<tr><th>ERROR</th><td>{{$errors->first('mail')}}</td></tr>
	@endif
    <tr><th>mail: </th><td><input type="text" name="mail" value="{{$form->mail}}"></td></tr>
    @if($errors->has('age'))
		<tr><th>ERROR</th><td>{{$errors->first('age')}}</td></tr>
	@endif
    <tr><th>age: </th><td><input type="text" name="age" value="{{$form->age}}"></td></tr>
    <tr><th></th><td><input type="submit" value="更新"></td></tr>
    </form>
    </table>
@endsection

@section('footer')
copyright 2019 yonetani.
@endsection
