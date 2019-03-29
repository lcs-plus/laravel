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

    const DELETED_AT = 'update_time';


    public static function getData($page = 30,$where){

        $data = self::where($where)->paginate($page);

        return $data;

    }


}
