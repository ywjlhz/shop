<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/20
 * Time: 21:53
 */

namespace Admin\Controller;


class AccessController extends CommonController
{
    public function index()
    {
        //根据rid查询对应角色
        $rid = I('rid');
        $this->assign('role_data',D('Role')->find($rid));
        //查询所有权限
        $datas = M('menu')->select();
        $datas = list_to_tree($datas);

        $this->assign('datas',$datas);

        //查询当前角色拥有权限
        $access_data = M('Access')->field('menu_id')->where('role_id='.$rid)->select();

        //获得的是一个二维数组,进行降维处理
        $access_data = array_column($access_data,'menu_id');

        $this->assign('access_data',$access_data);
        $this->display();
    }
    public function edit()
    {
        //后台接收数据
        $role_id = I('role_id');
        $menu_id = I('menu_id');
        //写入数据库
        //组装成一个二维数组
        foreach($menu_id as $key=>$value) {
            $arr[$key]['role_id'] = $role_id;
            $arr[$key]['menu_id'] = $value;
        }
        //清空原先权限
        M('Access')->where('role_id='.$role_id)->delete();
        $res = M('Access')->addAll($arr);
        if($res) {
            $this->success('权限添加成功',U('access/index','rid='.$role_id));
        }else {
            $this->error('权限添加失败');
        }
    }
}