<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/20
 * Time: 21:12
 */

namespace Admin\Model;


use Think\Model;

class MenuModel extends Model
{
    public function getList()
    {
        $res = $this->select();
        $res = getTree($res);
        return $res;
    }

    public function _before_insert(&$datas)
    {
        $datas['created_time']=time();
    }
    public function _before_update(&$datas)
    {
        $datas['updated_time']=time();
    }
}