<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/21
 * Time: 20:33
 */

namespace Admin\Model;


use Think\Model;

class AccessModel extends Model
{
    //获取当前用户的所有权限
    public function getAccess($role_id)
    {
        $datas = M('Access')->field('menu_id')->where('role_id='.$role_id)->select();
        foreach ($datas as $key=>$val) {
            $menu_datas = M('Menu')->field('id,menu_name,menu_controller,menu_action,pid,is_show')->find($val['menu_id']);
            $datas[$key]=$menu_datas;
        }
        return $datas;
    }

}