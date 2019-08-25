<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Person;
use App\application;

class AppMainController extends Controller
{

	
    public function show(Request $request){
	

		//セッション情報がない時のみ訪問者カウンターをインクリメントする
		if ("session" !== $request->session()->get('sessionkey')){

			$request->session()->put('sessionkey', 'session');

			$application = application::find(1);
			$application->increment('counter', 1);
		}
		
		//非ソート時(初期アクセス時)DB登録順にソート
		$sort = $request->sort;
		if(empty($sort)){
			$sort = 'id';
		}
		
		$items = Person::orderBy($sort, 'asc')->Paginate(5);


		$counter = application::all();
		return view('person.show', ['items' => $items, 'counter' => $counter, 'sort' => $sort]);
    }
}
