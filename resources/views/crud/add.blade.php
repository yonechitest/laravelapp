@extends('layouts.crud')
@section('title', 'Add Sushi🍣') 

@section('content')

@yield('content')



<div class="container">

    <h1>🍣Sushi Ingredient🍣</a></h1>

    <div class="card">

        <div class="card-header"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add Sushi</strong> <a href="/my-crud" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Browse Sushi</a></div>

        <div class="card-body">



            <div class="col-sm-6">

                <h5 class="card-title">Fields with <span class="text-danger">*</span> are mandatory!</h5>

                <form action="/my-crud/add" method="post" autocomplete="off">
                @csrf
                    <div class="form-group">

                        <label> Name <span class="text-danger">*</span></label>

                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Enter name" >

                        @foreach ($errors->get('name') as $message) 
                        <p class="text-danger"><i class="fa fa-fw text-warning fa-exclamation-triangle"></i>{{$message}}</p>
                        @endforeach
                        
                        

                    </div>

                    <div class="form-group">

                        <label> Price <span class="text-danger">*</span></label>

                        <input type="text" name="price" id="price" class="form-control" value="{{old('price')}}" placeholder="Enter Price" >

                        @foreach ($errors->get('price') as $message) 
                        <p class="text-danger"><i class="fa fa-fw text-warning fa-exclamation-triangle"></i>{{$message}}</p>
                        @endforeach

                    </div>

                    <div class="form-group">

                        <label> Note </label>

                        <input type="text" name="note" class="form-control" id="note" value="{{old('note')}}" placeholder="Enter Note" >

                        @foreach ($errors->get('note') as $message) 
                        <p class="text-danger"><i class="fa fa-fw text-warning fa-exclamation-triangle"></i>{{$note}}</p>
                        @endforeach

                    </div>

                    <div class="form-group">

                        <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Add Sushi</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
@endsection