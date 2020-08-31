@extends('layouts.crud')
@section('title', 'Browse Ramen🍜') 

@section('content')



@yield('content')

   	<div class="container">
			<div class=" title"> Recommended shop🍜<div class="sub-title">お気軽に推しのラーメンを登録ください</div></div>
			




		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-globe"></i> <strong>Browse Ramen</strong> <a href="/my-crud/add" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-plus-circle"></i> Add Ramen</a></div>
			<div class="card-body">
			<?php
				if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record deleted successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rus"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record updated successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnu"){
					echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> You did not change any thing!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
					echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> There is some thing wrong <strong>Please try again!</strong></div>';
				}
				?>
				<div class="col-sm-12">
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Find Ramen</h5>
					<form action="/my-crud" method="post" autocomplete="off">
						@csrf
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>Shop Name</label>
									<!-- 商品名 -->
									<input type="text" name="name" id="name" class="form-control" 
									value="{{ isset( $view_data['input_val'] ) ? $view_data['input_val']['name'] : null }}" placeholder="Enter Name">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Average price</label>
									<!-- 値段 -->
									<input type="text" name="price" id="price" class="form-control" 
									value="{{ isset( $view_data['input_val'] ) ? $view_data['input_val']['price'] : null }}" placeholder="Enter Price">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Note</label>
									<!-- 備考 -->
									<input type="text" name="note" id="note" class="form-control" 
									value="{{ isset( $view_data['input_val'] ) ? $view_data['input_val']['note'] : null }}" placeholder="Enter Note">
								</div>
							</div>
							<div class="col-sm-4">

								<div class="form-group">

									<label>Registration Date (yyyy-mm-dd)</label>
									<div class="input-group">

										<!-- 登録日From -->
										<input type="text" class="fromDate form-control hasDatepicker" name="RegistrationDateFrom" id="RegistrationDateFrom" 
										value="{{ isset( $view_data['input_val'] ) ? $view_data['input_val']['RegistrationDateFrom'] : null }}" placeholder="Enter from date">
										
										<div class="input-group-prepend"><span class="input-group-text">-</span></div>

										<!-- 登録日To -->
										<input type="text" class="toDate form-control hasDatepicker" name="RegistrationDateTo" id="RegistrationDateTo" 
										value="{{ isset( $view_data['input_val'] ) ? $view_data['input_val']['RegistrationDateTo'] : null }}" placeholder="Enter to date">
										
										<div class="input-group-append"><span class="input-group-text"><a href="javascript:;" onclick="$('#df,#dt').val('');"><i class="fa fa-fw fa-sync"></i></a></span></div>
									</div>

								</div>

							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>&nbsp;</label>
									<div>
										<button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<hr>
		
		<div>
			<div class="scroll">
				<table class="table table-striped table-bordered">
					<thead>
						<tr class="bg-primary text-white">
							<th class="align-middle " >Sr#</th>
							<th class="align-middle">Name</th>
							<th class="align-middle">Price</th>
							<th class="align-middle text-center">Note</th>
							<th class="text-center">Registration date</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>				
					@php ($i=0)
					@if (isset( $view_data['search_result'] ))
					@foreach ($view_data['search_result'] as $val) 				
					<tbody>
						<tr>
							<td>{{$id[$i]}}</td>
							@php (++$i)
							<td>{{$val->name}}</td>
							<td>{{$val->price}}</td>
							<td>{{$val->note}}</td>
							<td align="center">{{$val->create_date}}</td>
							<td align="center">
								<a href="{{ action('crud\MainPageController@editProduct', $val->id) }}" class="text-primary"><i class="fa fa-fw fa-edit"></i>Edit</a> |
								<a href="{{ action('crud\MainPageController@deleteProduct', $val->id) }}" class="text-danger" ><i class="fa fa-fw fa-trash"></i>Delete</a>
							</td>
						</tr>
					</tbody>
					@endforeach
					@else
						<tr><td colspan="6" align="center">No Records Found!</td></tr>
					@endif
				</table>
			</div>
		</div> <!--/.col-sm-12-->
		
	</div>
	
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
	<script src="https://www.solodev.com/_/assets/phone/jquery.mobilePhoneNumber.js"></script>
	<script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
    <script>
		$(document).ready(function() {
			jQuery(function($){
				  var input = $('[type=tel]')
				  input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
				  input.bind('country.mobilePhoneNumber', function(e, country) {
					$('.country').text(country || '')
				  })
			 });
			 
			 //From, To date range start
			var dateFormat	=	"yy-mm-dd";
			fromDate	=	$(".fromDate").datepicker({
				changeMonth: true,
				dateFormat:'yy-mm-dd',
				numberOfMonths:2
			})
			.on("change", function(){
				toDate.datepicker("option", "minDate", getDate(this));
			}),
			toDate	=	$(".toDate").datepicker({
				changeMonth: true,
				dateFormat:'yy-mm-dd',
				numberOfMonths:2
			})
			.on("change", function() {
				fromDate.datepicker("option", "maxDate", getDate(this));
			});
			
			
			function getDate(element){
				var date;
				try{
					date = $.datepicker.parseDate(dateFormat,element.value);
				}catch(error){
					date = null;
				}
				return date;
			}
			//From, To date range End here	
			
		});
	</script>
@endsection