<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\HelloRequest;
use Illuminate\Support\Facades\DB;
use App\Person;
use Validator;

class PersonController extends Controller
{

	public function show(Request $request){
		$page = $request->page;
		$items = DB::table('people')
			->get();
		return view('person.show', ['items' => $items]);
    }


    public function find(Request $request)
    {
        return view('person.find', ['input' => '']);
    }

    public function search(Request $request)
    {
        
        $keyword = $request->input;
        $items = Person::where('name', $keyword)->all();
        return view('person.find', ['input' => $keyword, 'items' => $items]);
    }

    public function add(Request $request)
    {
        return view('person.add');
    }

    public function create(Request $request)
    {
    	$this->validate($request, Person::$rules);
        $person = new Person;
        $form = $request->all();
        unset($form['_token']);//CSRF‚Ìƒg[ƒNƒ“‚ðÁ‚·

        $person->fill($form)->save();

        return redirect('/top');
    }

    public function edit(Request $request)
    {
        $person = Person::find($request->id);
        return view('person.edit', ['form' => $person]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Person::$rules);
        $person = Person::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/top');
	}

    public function delete(Request $request)
    {
        $person = Person::find($request->id);
        return view('person.del', ['form' => $person]);
    }

    public function remove(Request $request)
    {
        Person::find($request->id)->delete();
        return redirect('/top');
    }
}
