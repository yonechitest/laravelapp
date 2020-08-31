@extends('layouts.crud')
@section('title', 'Edit Ramen🍜') 


@section('content')

@yield('content')
	
   	<div class="container">

       <h1>🍜Ramen Ingredient🍜</a></h1>

		<div class="card">
			<div class="card-header">
                <i class="fa fa-fw fa-plus-circle"></i> <strong>Add Ramen</strong> 
                <a href="/my-crud" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-globe"></i> Search Ramen</a>
            </div>
			<div class="card-body">
				
				<div class="col-sm-6">
					<h5 class="card-title">Enter the information you want to change</h5>

                    @if (count($view_data['search_result']))
				    @foreach ($view_data['search_result'] as $val) 
					<form action="/my-crud/edit/{{ $val->id }}" method="post" autocomplete="off">
                    @csrf

                    <div class="form-group">

                        <label> Name </span></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" 
                        placeholder="{{ $val->name }}" >

                        @foreach ($errors->get('name') as $message) 
                        <p class="text-danger"><i class="fa fa-fw text-warning fa-exclamation-triangle"></i>{{$message}}</p>
                        @endforeach

                    </div>

                    <div class="form-group">

                        <label> Price </span></label>
                        <input type="text" name="price" id="price" class="form-control" value="{{old('price')}}" 
                        placeholder="{{ $val->price }}" >

                        @foreach ($errors->get('price') as $message) 
                        <p class="text-danger"><i class="fa fa-fw text-warning fa-exclamation-triangle"></i>{{$message}}</p>
                        @endforeach

                    </div>

                    <div class="form-group">

                        <label> Note </label>
                        <input type="text" name="note" class="form-control" id="note" value="{{ $val->note }}" 
                        placeholder="" >

                        @foreach ($errors->get('note') as $message) 
                        <p class="text-danger"><i class="fa fa-fw text-warning fa-exclamation-triangle"></i>{{$note}}</p>
                        @endforeach

                    </div>

						<div class="form-group">
							<input type="hidden" name="editId" id="editId" value="">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Update Ramen</button>
						</div>
					</form>
                    @endforeach
				    @endif
				</div>
			</div>
		</div>
	</div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    @endsection