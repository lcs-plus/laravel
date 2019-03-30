<?php

namespace App\Http\Controllers\Backend\menu;

use App\Http\Requests\Backend\Menu\NodeVerify;
use App\Models\Backend\menu\Node;
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

        return view('backend.menu.node.add', ['id' => $id]);

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
        $res = $nodeModel->insert($data);
        if ($res) {
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

        $node = Node::find($id);

        return view('backend.menu.node.edit', ['node' => $node]);

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
            return json_encode(['code' => 1, 'data' => '', 'message' => '删除成功']);
        } else {
            return json_encode(['code' => 0, 'data' => '', 'message' => '删除失败']);
        }
    }
}
