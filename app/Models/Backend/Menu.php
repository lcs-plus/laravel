<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    //

    use SoftDeletes;

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

    const DELETED_AT = 'delete_time';

    public function getDateAll($page = 20, $where)
    {


        if (!empty($where['page'])){
            unset($where['page']);
        }

        $menu = Menu::where($where)->paginate($page);

        return $menu;

    }

}
