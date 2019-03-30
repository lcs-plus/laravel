<?php

namespace App\Http\Controllers\Backend\menu;

use App\Http\Requests\Backend\Menu\NodeVerify;
use App\Models\Backend\Menu;
use App\Models\Backend\menu\Node;
use App\Models\Backend\menu\UserMenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = $request->all();

        $node = Node::getData(2, $data);

        return view('backend.menu.node.index', ['node' => $node]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = 0)
    {
        //
        $menu = Menu::all();

        return view('backend.menu.node.add', ['id' => $id, 'menu' => $menu]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NodeVerify $request)
    {
        //

        $nodeModel = new Node();
        $data = $request->all();
        $data['create_time'] = time();
        $data['update_time'] = time();

        $menus = $data['menu'];
        unset($data['menu']);

        $res = $nodeModel->insertGetId($data);

        if ($res) {


            $user_menusModel = new UserMenu();
            $user_menus = array();
            foreach ($menus as $k) {
                $um = [
                    'menus_id' => $k,
                    'node_id' => $res,
                    'create_time' => time(),
                    'update_time' => time()
                ];
                $user_menus[] = $um;
            }

            $user_menusModel->insert($user_menus);

            return json_encode(['code' => 1, 'data' => '', 'message' => '添加成功']);
        } else {
            return json_encode(['code' => 0, 'data' => '', 'message' => '添加失败']);
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
        $menu = Menu::all();
        $node = Node::find($id);
        $usermenu = UserMenu::where(['node_id' => $id])->get();

        $ids = [];
        foreach ($usermenu as $k) {
            $ids[] = $k->menus_id;
        }

        return view('backend.menu.node.edit', ['node' => $node, 'menu' => $menu, 'ids' => $ids]);

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


        $node = Node::find($id);
        $node->name = $request->get('name');
        $node->url = $request->get('url');
        $node->sort = $request->get('sort');
        $node->icon = $request->get('icon');
        $node->state = $request->get('state');
        $node->update_time = time();
        $res = $node->save();

        if ($res) {
            $menus = $request->get('menu');
            $menusUser = UserMenu::where(['node_id' => $id])->select('menus_id')->get();

            $ids = [];
            foreach ($menusUser as $k) {
                $ids[] = $k->menus_id;
            }



            $new_id = array_diff($menus, $ids);
            $old_id = array_diff($ids, $menus);

//            var_dump($menus);
//            var_dump($ids);
//            var_dump($new_id);
//            var_dump($old_id);exit();

            //DB::table('user_menus')->where(['node_id'=>$id,'in'=>['menus_id'=>$old_id]])->update(['delete_time'=>time()]);
            DB::table('user_menus')->whereIn('menus_id',$old_id)->where(['node_id'=>$id])->update(['delete_time'=>time()]);

            $user_menus = array();
            foreach ($new_id as $k) {
                $um = [
                    'menus_id' => $k,
                    'node_id' => $id,
                    'create_time' => time(),
                    'update_time' => time()
                ];
                $user_menus[] = $um;
            }
            $user_menusModel = new UserMenu();
            $user_menusModel->insert($user_menus);


            return json_encode(['code' => 1, 'data' => '', 'message' => '修改成功']);
        } else {
            return json_encode(['code' => 0, 'data' => '', 'message' => '修改失败']);
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

        $node = Node::find($id);

        $res = $node->delete();

        if ($res) {

            DB::table('user_menus')->where(['node_id' => $id])->update(['delete_time' => time()]);

            return json_encode(['code' => 1, 'data' => '', 'message' => '删除成功']);
        } else {
            return json_encode(['code' => 0, 'data' => '', 'message' => '删除失败']);
        }
    }
}
