<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/23
 * Time: 19:54
 */

namespace Home\Controller;


use Think\Controller;

class CommonController extends Controller
{
    /**
     * @function 构造方法,获取数据
     * @param void
     * @return void
     */
    public function _initialize(){
        //获取Category表中的所有分类
        $datas = M('Category')->where('display=1')->select();
        //将数据修改成树状结构
        $datas = list_to_tree($datas);
        //将变量分配到所有继承的模板中.
        $this->assign('header_category_datas',$datas);
    }
}