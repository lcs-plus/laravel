<?php

namespace App\Models\Backend\menu;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Node extends Model
{
    //

    use SoftDeletes;

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    const DELETED_AT = 'delete_time';


    public static function getData($page = 30,$where){

        if (empty($where['page'])){
            unset($where['page']);
        }

        $data = self::where($where)->paginate($page);

        return $data;

    }


    public static function getDataByUrl($url,$user_id){

        $list =self::where(['nodes.url'=>$url,'user_menus.menus_id'=>$user_id])
            ->join('user_menus','user_menus.node_id','=','nodes.id')
            ->first();


        if (empty($list)){
            return false;
        }

        return true;


    }


}
