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

    // CREATE TABLE `product` (
    //     `id` int(10) unsigned ZEROFILL NOT NULL AUTO_INCREMENT,
    //     `name` varchar(50) NOT NULL,
    //     `price` decimal(7,2) DEFAULT NULL,
    //     `note` varchar(50) DEFAULT NULL,
    //     `create_date` datetime NOT NULL COMMENT '(DC2Type:datetimetz)',
    //     `update_date` datetime NOT NULL COMMENT '(DC2Type:datetimetz)',
    //     `delete_date` datetime COMMENT '(DC2Type:datetimetz)',
    //     PRIMARY KEY (`id`)
    //   ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8
    //INSERT INTO `product` (`name`,`price`,`note`,`create_date`,`update_date`,`delete_date`) VALUES ('商品','１２３４５６７８９０','１２３４５６７８９０','2050-12-31 00:00:00','2050-12-31 00:00:00',null);

}