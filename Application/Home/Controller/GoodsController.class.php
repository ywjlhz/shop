<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/18
 * Time: 8:45
 */

namespace Home\Controller;


class GoodsController extends CommonController
{
    public function detail()
    {
        $id=I('id');
        //查找类型表
        //将商品信息查找出来展示到界面
        $datas = D('Goods')->find($id);
        //将属性值信息查找出来展示到界面
        $attr_datas = D('GoodsAttr')->where('goods_id='.$id)->select();
        foreach ($attr_datas as $key=>$value) {
            $attr_datas[$key]['goods_attr_value'] = explode(',',$attr_datas[$key]['goods_attr_value']);
        }
        //将商品相册信息查找出来展示到界面
        $img_datas = M('GoodsImg')->where('goods_id='.$id)->select();
        $this->assign('img_datas',$img_datas);
        $this->assign('attr_datas',$attr_datas);
        $this->data=$datas;
        $this->display();
    }
    public function showlist()
    {
        //接收分类ID
        $id = I('id');
        //将分类ID返回到界面
        $this->assign('category_id',$id);
        //接收品牌ID
        $brand_id=I('brand_id');
        $brand_id = !empty($brand_id)?$brand_id:0;
        //将品牌ID返回到界面
        $this->assign('brand_id',$brand_id);

        //查找所有分类
        $cate_datas = M('Category')->select();
        $cate_datas = getParentTree($cate_datas,$id);

        //计算当前页的总条数
        $goods_count = 0;
        //sql拼接
        $where = "display=1";
        if($brand_id) {
            $where.=' and brand_id='.$brand_id;
            foreach($cate_datas as $key=>$val) {
                $goods_count += D('Goods')->where($where.' and category_id='.$val['id'])->count();
            }
        }else {
            foreach($cate_datas as $key=>$val) {
                $goods_count += D('Goods')->where('display=1 and category_id='.$val['id'])->count();
            }
        }
            //实例化分页类
            $page = new \Think\Page($goods_count,1);

            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('first', '首页');
            $page->setConfig('last', '尾页');
            $page->lastSuffix = false;
            //获得分页
            $paging = $page->show();
            //向模板展示
            $this->assign('paging',$paging);

        //遍历分类树，查询出所有商品
        if($brand_id) {
            foreach($cate_datas as $key=>$val) {
                $goods_datas = D('Goods')
                    ->limit($page->firstRow, $page->listRows)
                    ->where($where)
                    ->select();
            }
        }else {
            foreach($cate_datas as $key=>$val) {
                $goods_datas = D('Goods')
                    ->limit($page->firstRow, $page->listRows)
                    ->where($where.' and category_id='.$val['id'])
                    ->select();
            }
        }
        //展示到模板中
        $this->assign('datas',$goods_datas);

        //查询所有品牌信息并展示到模板
        $brand_datas = M('Brand')->select();
        $this->assign('brand_datas',$brand_datas);
        $this->display();
    }
}