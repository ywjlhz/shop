<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2017/9/20
 * Time: 1:59
 */

namespace Admin\Model;
use Common\Model;

class GoodsImgModel extends Model\BasegoodsModel
{
    public function _before_insert(&$datas)
    {
        $datas['created_time']=time();
    }
}