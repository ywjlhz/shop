<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/16
 * Time: 11:32
 */
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller
{
    public function _initialize()
    {
        //parent::__construct();
        //TP框架controller封装了.可以使用initialize代替
        if(!session('?login_info')) {
            $this->error('非法访问,请先登录',U('login/login'));
        }


        //查询出当前用户的所有权限
        $datas = D('Access')->getAccess($_SESSION['login_info']['role_id']);
        //判断用户是否有操作权限
//        print_r('<pre>');
//        print_r($datas);
        //循环数据得到用户的每一条权限的控制器与方法
        foreach($datas as $key=>$value) {
            //循环出控制器与方法不为空的数据
            if($value['menu_controller']) {
                //转换成小写并与方法拼接成URL
                $arr[$key] = strtolower($value['menu_controller'].$value['menu_action']);
            }
        }

        //通过TP框架自带常量，获取控制器与方法名
        $url = strtolower(CONTROLLER_NAME.ACTION_NAME);
        //判断$url是否在数组中，从而判断用户有没有访问权限
        if(!in_array($url,$arr)&&$_SESSION['login_info']['username']!='admin') {
            $this->error('没有权限，别烦我~~~');
        }
    }
}