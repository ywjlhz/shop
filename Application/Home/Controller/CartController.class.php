<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/26
 * Time: 20:09
 */

namespace Home\Controller;


use function Sodium\add;
use Think\Page;

class CartController extends CommonController
{
    public function index()
    {
        //定义总价
        $total = 0;
        //判断用户是否登录
        if(!session('?uid')) {
            //未登录则从cookie中取数据
            $datas = unserialize(cookie('cart_data'));
            $goods_datas = D('Cart')->getGoodsInfo($datas);
            //循环cookie中数据计算总价
        }else {
            //已登陆
            //判断cookie是否有商品
            if($old_data = cookie('cart_data')) {
                //有商品，则将cookie中数据同步添加到数据库
                $old_data = unserialize($old_data);
                //获取cookie中的数据
                $goods_datas = D('Cart')->getGoodsInfo($old_data);
                //循环cookie商品加入购物车
                D('Cart')->cookieAdd($goods_datas);
            }
            //显示用户购物车表里的数据
            $goods_datas = M('Cart')->where('uid='.session('uid'))->select();
            foreach ($goods_datas as $key=>$val) {
                $goods_datas[$key]['goods_attr_value'] = unserialize($val['goods_attr']);
            }
        }
        //计算总价与小计
        foreach ($goods_datas as $key=>$val) {
            $subtotal = $val['goods_cart_count']*$val['goods_price'];
            $goods_datas[$key]['subtotal'] = $subtotal;
                $total+=$subtotal;
            }
        $this->assign('total',$total);
        $this->assign('goods_data',$goods_datas);
        $this->display();
    }
    public function add()
    {
        //接收用户提交的数据
        $datas = I('post.');
        //查询当前商品信息
        $goods_datas = D('Goods')->find($datas['goods_id']);
        //判断用户是否登录
        if(!session('?uid')) {
            //未登录时,添加到cookie中
            //判断原cookie中是否有数据
            if($old_data = cookie('cart_data')) {
                $old_data = unserialize($old_data);
                $old_data[$datas['goods_id']] = $datas;
                $new_arr = $old_data;
            }else {
                $new_arr[$datas['goods_id']] = $datas;
            }
            $cart_str = serialize($new_arr);
            cookie('cart_data',$cart_str,3600*24*7);
            if(cookie('cart_data')) {
                $this->success('收藏成功',U('index'));
            }else {
                $this->error('服务器繁忙,请稍后再试...');
            }
        }else {
            //登录则保存到购物车表中
            //判断购物车表中是否存在此商品
            $cart_data = M('Cart')->where('goods_id='.$datas['goods_id'].' and uid='.session('uid'))->find();
            //增加数据
            $add_data['uid'] = session('uid');
            $add_data['goods_id'] = $datas['goods_id'];
            $add_data['goods_attr'] = serialize($datas['attr']);
            $add_data['goods_cart_count'] = $datas['number'];
            $add_data['goods_title'] = $goods_datas['goods_name'];
            $add_data['goods_thumb_img'] = $goods_datas['goods_thumb_img'];
            $add_data['goods_price'] = $goods_datas['goods_price'];
            $add_data['goods_mkprice'] = $goods_datas['goods_mkprice'];
            $add_data['created_time'] = time();
            $add_data['exp_time'] = time()+3600*24*7;
            if($cart_data) {
                //更新操作
                $res = M('Cart')->where("id=".$cart_data['id'])->save($add_data);
            }else {
                //增加操作
                $res = M('Cart')->add($add_data);
            }
            if($res) {
                $this->success('收藏成功',U('index'));
            }else {
                $this->error('服务器繁忙,请稍后再试...');
            }
        }
    }
    public function edit()
    {
        $goods_id = I('goods_id');
        $goods_cart_count = I('goods_cart_count');
        //更新数据库信息
        $res = D('Cart')->cartEdit($goods_id,$goods_cart_count);
        if($res) {
            $this->ajaxReturn(array('status'=>1,'msg'=>'修改成功'));
        }else {
            $this->ajaxReturn(array('status'=>0,'msg'=>'服务器繁忙'));
        }
    }
}