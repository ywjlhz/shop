<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/9/24
 * Time: 1:00
 */

namespace Home\Model;


use Think\Model;

class UserModel extends Model
{
    protected $_validate = array(
        array('username','require','用户名不能为空'),
        array('username','','此用户名太受欢迎',0,'unique',1),
        array('password','require','密码不能为空'),
        array('password2','require','请确认密码'),
        array('password2','password','两次输入的密码不一致',0,'confirm'),
        array('qq','number','请填写正确的qq'),
        array('email','require','邮箱不能为空'),
        array('email','email','请填写正确的邮箱'),
        array('phone','require','手机号不能为空'),
        array('phone','number','请填写正确的手机号'),
        array('phone','11','手机号长度不符',3,'length'),
    );
    public function _before_insert(&$datas)
    {
        $datas['password'] = md5($datas['password']);
        $datas['created_time'] = time();
        $datas['updated_time'] = time();
        return $datas;
    }

}