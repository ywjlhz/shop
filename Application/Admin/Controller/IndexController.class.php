<?php
namespace Admin\Controller;
class IndexController extends   CommonController
{
    public function index()
    {
        $time=time();
        $this->assign('time',$time);
        $this->display();
    }
    public function left()
    {
        //从登陆用户的session中获取role_id，知道当前用户的角色
        $role_id = ($_SESSION['login_info']['role_id']);
        //查找当前角色的菜单列表
        $data = M('Access')->where('role_id='.$role_id)->order('menu_id asc')->select();
        foreach($data as $value) {
            //获取menu_id. 并查找此菜单对应的数据插入数组
            $datas[]=M('Menu')->find($value['menu_id']);
        }
        //调用list_to_tree 获得树状结构
        $datas = list_to_tree($datas);
        //将数据展示到模板
        $this->assign('datas',$datas);
        $this->display();
    }
}