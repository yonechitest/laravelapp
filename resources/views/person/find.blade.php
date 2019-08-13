@extends('layouts.helloapp')

@section('title', 'Person.find')

@section('menubar')
    @parent
    検索ページ
@endsection

@section('content')
    <form action="/person/find" method="post">
    {{ csrf_field() }}
    <input type="text" name="input" value="{{$input}}">
    <input type="submit" value="検索">
    </form>
    @if ($items != null)
        @foreach($items as $item)
    
    <table>
    <tr><th>Data</th></tr>
    <tr>
       <td>{{$item->name}}</td>
    </tr>
    </table>
    	@endforeach
    @endif
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
