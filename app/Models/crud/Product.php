<?php

namespace App\Models\crud;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Product extends Model
{

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * テーブルの主キー
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * IDが自動増分されるか
     *
     * @var bool
     */
    public $incrementing = true;


    /**
     * モデルのタイムスタンプを更新するかの指示
     *
     * @var bool
     */
    public $timestamps = false;

    protected $dates = [
        'creation_date',
    ];


}