<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    //
    use SoftDeletes;

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    const DELETED_AT = 'update_time';


    public static function addTable(Request $request,$remark='跳转', $table_name = '', $table_id = 0)
    {

        $data = [
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $request->session()->get('id')??0,
            'url' => 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"],
            'table_name' => $table_name,
            'table_id' => $table_id,
            'create_time' => time(),
            'update_time' => time(),
            'remark'=>$remark,
        ];
        Log::insert($data);

    }

}
