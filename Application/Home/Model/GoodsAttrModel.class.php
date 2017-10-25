<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/24
 * Time: 20:17
 */

namespace Home\Model;


use Think\Model;

class GoodsAttrModel extends Model
{
    public function _after_select(&$datas)
    {
        //遍历查询到的数据
        foreach ($datas as $key=>$val) {
            $attribute_datas = M('Attribute')->field('attr_name,attr_type')->find($val['attr_id']);
            $datas[$key]['attr_name'] = $attribute_datas['attr_name'];
            $datas[$key]['attr_type']=$attribute_datas['attr_type'];
        }
        return $datas;
    }
}