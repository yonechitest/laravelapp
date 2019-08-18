<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Person;
use App\application;

class AppMainController extends Controller
{

	
    public function show(Request $request){
	


		//�Z�b�V������񂪂Ȃ����̂ݖK��҃J�E���^�[���C���N�������g����
		if ("session" !== $request->session()->get('sessionkey')){

			$request->session()->put('sessionkey', 'session');

			$application = application::find(1);
			$application->increment('counter', 1);

		}
		
		$counter = application::all();

		$items = DB::table('people')->get();
		
		return view('person.show', ['items' => $items, 'counter' => $counter]);
    }
}
