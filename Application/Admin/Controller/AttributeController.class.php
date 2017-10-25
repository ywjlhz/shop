<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/21
 * Time: 15:53
 */

namespace Admin\Controller;


class AttributeController extends CommonController
{
    //显示属性列表
    public function index()
    {
        $this->assign('datas',D('Attribute')->select());
        $this->display();
    }
    //添加属性
    public function add()
    {
        if(IS_POST) {
            $datas = I('post.');
            $res = M('Attribute')->add($datas);
            if($res) {
                $this->success('添加成功',U('index'));die;die;
            }else {
                $this->error('添加失败');die;
            }
        }
        //查出所有类型展示到下拉框
        $this->assign('datas',M('Cate')->select());
        $this->display();
    }
    //修改属性
    public function edit()
    {
        //判断用户是否提交数据
        if(IS_POST) {
            $datas = I('post.');
            $res = M('Attribute')->save($datas);
            if($res) {
                $this->success('修改成功',U('index'));die;
            }else {
                $this->error('修改失败');die;
            }
        }
        //展示需要修改的属性
        //接收需要修改的ID
        $id = I('id');
        $data = M('Attribute')->find($id);
        $this->assign('data',$data);
        //查出所有类型展示到下拉框
        $this->assign('datas',M('Cate')->select());
        $this->display();
    }
    //删除属性
    public function del()
    {
        $id = I('id');
        $res = M('Attribute')->delete($id);
        if($res) {
            $this->success('删除成功',U('index'));die;
        }else {
            $this->error('删除失败');die;
        }
        $this->display();
    }

    public function getAttribute($cate_id)
    {
        //从对应cate_id到属性表查询对应的属性
        $datas = M('Attribute')->where(array('cate_id'=>$cate_id))->select();
        $this->ajaxReturn($datas);
    }
}