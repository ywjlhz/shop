<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/20
 * Time: 15:46
 */

namespace Admin\Controller;

class RoleController extends CommonController
{
    public function index()
    {
        $datas = M('Role')->select(array('status=1'));
        $this->assign('datas',$datas);
        $this->display();
    }

    public function add()
    {
        if(IS_POST) {
            $datas = I('post.');
            $res = D('Role')->add($datas);
            if($res) {
                $this->success('增加成功',U('index'));die;
            }else {
                $this->error('操作失败');die;
            }
        }
        $this->display();
    }

    public function edit()
    {
        if(IS_POST) {
            $datas = I('post.');
            $res = D('Role')->save($datas);
            if($res) {
                $this->success('修改成功',U('index'));die;
            }else {
                $this->error('操作失败');die;
            }
        }
        //接收需要修改的角色的id
        $id = I('id');
        $data = M('Role')->find($id);
        $this->assign('data',$data);
        $this->display();
    }

    public function del()
    {
        $id = I('id');
        $res = M('Role')->delete($id);
        if($res) {
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除成功'));
        }else {
            $this->ajaxReturn(array('status'=>1,'msg'=>'删除失败'));
        }
    }
}