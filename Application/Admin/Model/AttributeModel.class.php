<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/22
 * Time: 14:54
 */

namespace Admin\Model;


use Think\Model;

class AttributeModel extends Model
{
    public function _after_select(&$datas)
    {
        foreach ($datas as $key=>$value) {
            $cate_data = M('Cate')->field('cate_name')->find($value['cate_id']);
            $datas[$key]['cate_name']=$cate_data['cate_name'];
        }
        return $datas;
    }
}