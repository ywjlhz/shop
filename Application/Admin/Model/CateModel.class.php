<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/22
 * Time: 16:09
 */

namespace Admin\Model;


use Think\Model;

class CateModel extends Model
{
    public function getList()
    {
        $res = $this->select();
        return $res;
    }
}