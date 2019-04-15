<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Key extends Model
{
    //
    use SoftDeletes;

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    const DELETED_AT = 'delete_time';


    public static function getDataAll($page=30,$where){

        if (empty($where['page'])){
            unset($where['page']);
        }

        $data = self::where($where)->paginate($page);

        return $data;
    }

}
