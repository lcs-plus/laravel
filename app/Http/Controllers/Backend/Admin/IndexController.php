<?php
/**
 * Created by PhpStorm.
 * User: damai
 * Date: 2019/3/27
 * Time: 10:22
 */

namespace App\Http\Controllers\Backend\Admin;


class IndexController extends BaseController
{

    public function index(){


        return view('backend.admin.index.index');


    }

}