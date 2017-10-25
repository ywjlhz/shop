<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/20
 * Time: 20:19
 */

namespace Admin\Model;


use Think\Model;

class RoleModel extends Model
{
    public function _before_insert(&$datas)
    {
        $datas['created_time']=time();
    }
    public function _before_update(&$datas)
    {
        $datas['updated_time']=time();
    }
}