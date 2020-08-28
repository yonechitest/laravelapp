<?php

namespace App\Http\Controllers\crud;

use App\Http\Controllers\Controller;
use App\Models\crud\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\crud\AddProductRequests;
use App\Http\Requests\crud\CreateProductRequests;
use Illuminate\Support\Facades\Cookie;

class MainPageController extends Controller
{

    private $view_data = [];  //bladeに渡すデータ
    private $dt;  //Carbonインスタンス

    // コンストラクタ
    public function __construct()
    {
    $this->view_data = [];
    $this->dt = new Carbon();
    }

    /**
     * 登録データの表示
     *
     * @param  
     * @return View
     */
    public function showProducts()
    {

        $search_result = Product::
            select('id','name','price','note','create_date')
            ->whereNull('delete_date')       
            ->get();

        if (empty($search_result)) {

            $this->view_data['no_result'] = "No Record Found!";

        } elseif (!empty($search_result)) {

            foreach ($search_result as $value) {
                $carbon = $this->dt->parse($value->create_date);
                $value->create_date = $carbon->format('Y/m/d');
            }
            $this->view_data['search_result'] = $search_result;

        }

        //IDに使う連番を作成
        $id =range(1, $search_result->count() );
        $this->view_data['id'] = $id;

        $view_data = $this->view_data;

        return view('crud.main', compact('view_data', 'id'));
    }

    /**
     * productテーブル検索
     *
     * @param  Request  $request
     * @return View
     */
    public function searchProducts(Request $request)
    {        

        $search_result = Product::query();

        //hasメソッドを使用（値が存在、かつ空ではないか）
        if(!is_null($request->get('name'))) {
            $search_result->where('name', 'LIKE', '%'.$request->get('name').'%');
        }
        if(!is_null($request->get('price')) ) {
            $search_result->where('price', $request->get('price'));
        }
        if(!is_null($request->get('note'))) {
            $search_result->where('note', 'LIKE', '%'.$request->get('note').'%');
        }
        if(!is_null($request->get('RegistrationDateFrom'))) {
            $search_result->whereDate('create_date', '>=', $this->dt->parse($request->get('RegistrationDateFrom')));
        }
        if(!is_null($request->get('RegistrationDateTo'))) {
            $search_result->whereDate('create_date', '<=', $this->dt->parse($request->get('RegistrationDateTo')));
        }

        // nameとpriceはまとめることも可能
        // foreach ($request->only(['name', 'price']) as $key => $value) {
        //     $query->where($key, 'like', '%'.$value.'%');
        // }

        //delete_dateにがnullのものを取り出す
        $search_result = $search_result
                            ->whereNull('delete_date')       
                            ->get();

        //日付をYYYY年MM月DD日にの形に変更
        if (empty($search_result)) {

            $this->view_data['no_result'] = "No Record Found!";

        } elseif (!empty($search_result)) {

            foreach ($search_result as $value) {
                $carbon = $this->dt->parse($value->create_date);
                $value->create_date = $carbon->format('Y/m/d');
            }
            $this->view_data['search_result'] = $search_result;
            
        }

        //IDに使う連番を作成
        $id =range(1, $search_result->count() );
        $this->view_data['id'] = $id;

        $this->view_data['input_val'] = $request->input();
        $view_data = $this->view_data;

        return view('crud.main', compact('view_data', 'id'));
    }

    /**
     * データ追加フォーム画面表示
     *
     * @param  Request  $request
     * @return view
     */
    public function addProduct(Request $request)
    {
        return view('crud.add');
    }

    /**
     * productテーブルにレコード追加
     *
     * @param  AddProductRequests $request
     * @return View
     */
    public function createProduct(AddProductRequests $request)
    {
        //AddProductRequestsでバリデートチェック

        $product = new Product;

        $product->name = $request->name;
        $product->price = $request->price;
        $product->note = $request->note;
        $product->create_date = $this->dt;
        $product->update_date = $this->dt;
        $product->save();

        return redirect('/my-crud');
    }

    /**
     * データ更新form画面を更新
     *
     * @param  Request  $request
     * @return View
     */
    public function editProduct(Request $request)
    {
        $search_result = Product::
            select('id','name','price','note')
            ->where([["id", "=" , $request->id]])
            ->get();

        $this->view_data['search_result'] = $search_result;
        $view_data = $this->view_data;

        return view('crud.edit', compact('view_data'));
    }

    /**
     * productテーブルのレコード追加
     *
     * @param  CreateProductRequests  $request
     * @return View
     */
    public function updateProduct(CreateProductRequests $request)
    {
        //AddProductRequestsでバリデートチェック

        $product = Product::find($request->id);

        if(!is_null($request->get('name'))) {
            $product->name = $request->name;
        }
        if(!is_null($request->get('price')) ) {
            $product->price = $request->price;
        }
        if(!is_null($request->get('note'))) {
            $product->note = $request->note;
        }
        $product->save();

        return redirect('/my-crud');
    }

    /**
     * 削除確認画面表示
     *
     * @param  Request  $request
     * @return View
     */
    public function deleteProduct(Request $request)
    {
        $search_result = Product::
            select('id','name','price','note')
            ->where([["id", "=" , $request->id]])
            ->get();

        $this->view_data['search_result'] = $search_result;
        $view_data = $this->view_data;

        return view('crud.delete', compact('view_data'));
    }

    /**
     * Productテーブルのレコードを論理削除
     *
     * @param  Request  $request
     * @return View
     */
    public function destroyProduct(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete_date = $this->dt->now();
        $product->save();

        return redirect('/my-crud');
    }

}


