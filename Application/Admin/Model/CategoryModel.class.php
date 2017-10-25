<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/17
 * Time: 21:57
 */

namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model
{
    public function _before_insert(&$datas)
    {
        $datas['created_time'] = time();
    }
    public function _before_update(&$datas)
    {
        $datas['updated_time'] = time();
    }

    public function getList()
    {
        //获取所有分类信息
        $res = $this->where('display=1')->select();
        $res = getTree($res);
        return $res;
    }
}