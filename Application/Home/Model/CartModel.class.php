<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/27
 * Time: 22:01
 */

namespace Home\Model;


use Think\Model;

class CartModel extends Model
{
    public function getGoodsInfo($datas)
    {
        foreach ($datas as $key=>$val) {
            //根据$key查出商品数据
            $goods_data = D('Goods')->find($key);
            if($val['goods_id']==$goods_data['id']) {
                $goods_data['goods_id'] = $key;
                $goods_data['goods_cart_count'] = $datas[$key]['number'];
                $goods_data['goods_attr_value'] = $datas[$key]['attr'];
                $goods_data['subtotal'] = $datas[$key]['number']*$goods_data['goods_price'];
            }
            $goods_datas[] = $goods_data;
        }
        return $goods_datas;
    }

    public function cartEdit($goods_id,$goods_cart_count)
    {
        //判断当前用户是否登录
        if(session('?uid')) {
            //登录则修改数据库中信息
            $res = $this->where('goods_id='.$goods_id.' and uid='.session('uid'))->save(array('goods_cart_count'=>$goods_cart_count));
            return $res;
        }else {
            //未登录则修改cookie中的信息
            $datas = unserialize(cookie('cart_data'));
            $datas[$goods_id]['number'] = $goods_cart_count;
            $cart_datas = serialize($datas);
            cookie('cart_data',$cart_datas,3600*7*24);
            return true;
        }
    }
    public function cookieAdd($goods_datas)
    {
        //循环cookie中的数据
        foreach ($goods_datas as $key=>$val) {
            $cart_data = M('Cart')->where('uid='.session('uid').' and goods_id ='.$val['id'])->find();
            $add_data['uid'] = session('uid');
            $add_data['goods_id'] = $val['id'];
            $add_data['goods_attr'] = serialize($val['goods_attr_value']);
            $add_data['goods_cart_count'] = $val['goods_cart_count'];
            $add_data['goods_name'] = $val['goods_name'];
            $add_data['goods_thumb_img'] = $val['goods_thumb_img'];
            $add_data['goods_price'] = $val['goods_price'];
            $add_data['goods_mkprice'] = $val['goods_mkprice'];
            $add_data['created_time'] = $val['created_time'];
            $add_data['exp_time'] = $val['created_time']+3600*7*24;
            if($cart_data) {
                //购物车存在则更新数据
                $res = M('Cart')->where('uid='.session('uid').' and goods_id ='.$val['id'])->save($add_data);
            }else {
                //不存在则插入
                $res = M('Cart')->add($add_data);
            }
            if($res) {
                cookie(null);
            }
        }
    }
}