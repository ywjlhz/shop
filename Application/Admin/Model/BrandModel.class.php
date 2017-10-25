<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/15
 * Time: 10:05
 */

namespace Admin\Model;
use Think\Model;

class BrandModel extends Model
{
    protected $_validate = array(
        array('brand_name','require','品牌名称不能为空'),
        array('brand_sort','require','品牌排序不能为空')
    );
    protected $_map = array(
      'name'=>'brand_name',
      'sort'=>'brand_sort',
    );
    public function _before_insert(&$datas)
    {
        $datas['created_time']=time();
    }
    public function _before_update(&$datas)
    {
        $datas['updated_time']=time();
    }
    public function getList()
    {
        //实现品牌查询.
        //如果当前模型名与表名一致.M('') <==> $this
        $res = $this->where('display=1')->select();
        return $res;
    }
}