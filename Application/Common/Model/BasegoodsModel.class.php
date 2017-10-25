<?php
namespace Common\Model;
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/17
 * Time: 19:25
 */
use Think\Model;
class BasegoodsModel extends Model
{
    public function _after_find(&$datas)
    {
            $brand_data = M('Brand')->field('brand_name')->where('display<>0')->find($datas['brand_id']);
            $category_data = M('Category')->field('category_name')->where('display<>0')->find($datas['category_id']);
            $datas['brand_name']=$brand_data['brand_name'];
            $datas['category_name']=$category_data['category_name'];
        return $datas;
    }
    public function _after_select(&$datas)
    {
        foreach ($datas as $key=>$value) {
            $brand_data = M('Brand')->field('brand_name')->where('display<>0')->find($value['brand_id']);
            $category_data = M('Category')->field('category_name')->where('display<>0')->find($value['category_id']);
            $datas[$key]['brand_name']=$brand_data['brand_name'];
            $datas[$key]['category_name']=$category_data['category_name'];
        }
        return $datas;
    }
}