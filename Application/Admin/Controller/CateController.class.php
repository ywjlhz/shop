<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/21
 * Time: 15:02
 */

namespace Admin\Controller;


class CateController extends CommonController
{
    public function index()
    {
        $datas = M('Cate')->select();
        $this->assign('datas',$datas);
        $this->display();
    }
    //增加方法
    public function add()
    {
        if(IS_POST) {
            $model = M('Cate');
            $res = $model->add(I('post.'));
            if($res) {
                $this->success('增加成功',U('index'));die;
            }else {
                $this->error('增加失败');
            }
        }
        $this->display();
    }
    public function edit()
    {
        //判断用户是否提交修改数据
        if(IS_POST) {
            $data = I('post.');
            $res = M('Cate')->save($data);
            if($res) {
                $this->success('修改成功',U('index'));die;
            }else {
                $this->error('修改失败');
            }
        }
        //接收前台传递的ID
        $id = I('id');
        //查找数据
        $this->assign('datas',M('Cate')->find($id));
        $this->display();
    }
    public function del()
    {
        //接收要删除的ID
        $id = I('id');
        $res = M('Cate')->delete($id);
        if($res) {
            $this->success('删除成功',U('index'));die;
        }else {
            $this->error('删除失败');
        }
        $this->display();
    }
}