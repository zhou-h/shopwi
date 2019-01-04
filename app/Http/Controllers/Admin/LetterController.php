<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//导入表单请求校验类
use App\Http\Requests\AdminLetter;
class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        // 站内信列表
        //获取搜索关键词
        $k=$request->input('keywords');
        //获取列表数据
        $data = DB::table('letter')->where("sender",'like',"%".$k."%")->paginate(5);
        return view('Admin.Letter.letter',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //发送站内信
        return view('Admin.Letter.letter-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminLetter $request)
    {
        $data = $request->except('_token');
        $data['status']=0;
        // var_dump($data['sender']);{

        // // 判断收件人是否存在
        if (!DB::table('user')->where('username','=',$data['sender'])->first()) {
            $request->flash();
            return redirect("/letter/create")->with('error','收件人不存在，请更改收件人');
        }
        // exit;
        if (DB::table('letter')->insert($data)) {
             return redirect("/letter")->with('success','数据添加成功'); 
        }else             
            return redirect("/letter")->with('error','数据添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
// }
