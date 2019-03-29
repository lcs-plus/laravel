<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Models\Backend\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $date = $request->all();

        $menuModel = new Menu();

        $menu = $menuModel->getDateAll(1,$date);

        return view('backend.menu.menu.index', ['menu' => $menu]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('backend.menu.menu.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $data = $request->all();

        $validateData = $this->validate($request,[
            'name'=>'required',
        ]);

        if ($validateData){
            return json_encode(['code'=>0,'data'=>$validateData,'message'=>$validateData]);
        }

        $data['create_time'] = time();
        $data['update_time'] = time();

        $menuModel = new Menu();
        $res = $menuModel->insert($data);
        if ($res){
            return json_encode(['code'=>1,'data'=>'','message'=>'添加成功']);
        }else{
            return json_encode(['code'=>0,'data'=>'','message'=>'添加失败']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $menu = Menu::find($id);

        return view('backend.menu.menu.edit',['menu'=>$menu]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $data = $request->all();

        $validateData = $this->validate($request,[
            'name'=>'required',
        ]);

        if ($validateData){
            return json_encode(['code'=>0,'data'=>$validateData,'message'=>$validateData]);
        }

        $data['update_time'] = time();

        $menu = Menu::find($id);

        $menu->name=$data['name'];
        $menu->state=$data['state'];
        $menu->update_time = time();
        $res = $menu->save();
        if ($res){
            return json_encode(['code'=>1,'data'=>'','message'=>'保存成功']);
        }else{
            return json_encode(['code'=>0,'data'=>'','message'=>'保存失败']);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $menu = Menu::find($id);

        $res = $menu->delete();

        if ($res){
            return json_encode(['code'=>1,'data'=>'','message'=>'删除成功']);
        }else{
            return json_encode(['code'=>0,'data'=>'','message'=>'删除失败']);
        }


    }
}
