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
		
		//��\�[�g��(�����A�N�Z�X��)DB�o�^���Ƀ\�[�g
		$sort = $request->sort;
		if(empty($sort)){
			$sort = 'id';
		}
		
		$items = Person::orderBy($sort, 'asc')->Paginate(5);


		$counter = application::all();
		return view('person.show', ['items' => $items, 'counter' => $counter, 'sort' => $sort]);
    }
}
