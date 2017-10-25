<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/18
 * Time: 19:01
 */

namespace Home\Model;


use Common\Model\BasegoodsModel;

class GoodsModel extends BasegoodsModel
{
    public function _after_find(&$datas)
    {
        //在查询商品之后加上商品属性值
        $goods_attr_datas = M('GoodsAttr')->field('attr_id,goods_attr_value')->where('goods_id='.$datas['id'])->select();

        //根据attr_id查出属性名
        foreach ($goods_attr_datas as $key=>$val) {
            $attr_name = M('Attribute')->field('attr_name')->find($val['attr_id']);
            $arr[$attr_name['attr_name']] = $val['goods_attr_value'];
            $val=$arr;
            $datas['goods_attr']=$val;
        }
        return $datas;
    }
}