<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/20
 * Time: 21:11
 */

namespace Admin\Controller;


class MenuController extends CommonController
{
    public function index()
    {
        $datas = M('Menu')->select();
        $datas = getTree($datas);
        $this->assign('datas',$datas);
        $this->display();
    }

    public function add()
    {
        //判断用户是否提交数据
        if(IS_POST) {
            $datas = I('post.');
            $res = M('Menu')->add($datas);
            if($res) {
                $this->success('添加成功',U('index'));die;
            }else {
                $this->error('添加失败');die;
            }
        }
        $this->assign('data', D('Menu')->getList());
        $this->display();
    }

    public function edit()
    {
        //获取需要修改的菜单ID
        $id = I('id');
        //展示数据到模板
        $this->assign('datas',M('Menu')->find($id));
        $this->assign('data', D('Menu')->getList());
        $this->display();
    }
    public function menuyz()
    {
        //接收要删除的ID
        $id = I('id');
        //判断是否存在子集
        $datas = M('Menu')->where('pid='.$id)->select();
        if(!empty($datas)) {
            $this->ajaxReturn(array('status'=>0,'msg'=>'存在子菜单,禁止删除'));
        }else {
            $this->ajaxReturn(array('status'=>1,'msg'=>'是否确认删除'));
        }
    }
    public function del()
    {
        //接收用户是否确认删除
        $id = I('id');
        if($id!=0) {
            //删除菜单
            $res = M('Menu')->delete($id);
            if($res) {
                //如果删除成功,则删除关系表中对应数据
                M('Access')->where('menu_id='.$id)->delete();
                $this->ajaxReturn(array('status'=>0,'msg'=>'删除成功'));
            }else {
                $this->ajaxReturn(array('status'=>1,'msg'=>'删除失败'));
            }
        }else {
            $this->ajaxReturn(array('status'=>2,'用户取消操作'));
        }
    }
}