<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/17
 * Time: 16:37
 */

namespace Admin\Model;
use Common\Model;

class GoodsModel extends Model\BasegoodsModel
{
    public function goodsAdd($datas)
    {
        //判断用户是否上传
        if (!empty($_FILES['goods_big_img']['name'])) {
            $datas = $this->uploadImg($datas);
        }
        $datas = $this->goodsXss($datas);
        $res = $this->add($datas);
        return $res;
    }
    public function goodsEdit($datas)
    {

        if (!empty($_FILES['goods_big_img']['name'])) {
            $datas = $this->uploadImg($datas);
        }
        $datas = $this->goodsXss($datas);
        $res = $this->save($datas);
        return $res;
    }

    private function goodsXss($datas)
    {
        $datas['goods_description'] = htmlXss($datas['goods_description']);
        $datas['goods_description'] = $datas['goods_description'];
        return $datas;
    }

    private function uploadImg($datas)
    {
        //调用上传方法.成功返回上传的图片信息
        $res = uploadFile('GOODS_CONF');
        $info = $res['info'];
        //没有上传成功则返回错误信息
        if (!$info) {
            $this->error($res['mgs']);
        }
        $datas['goods_big_img'] = $info['goods_big_img']['savepath'] . $info['goods_big_img']['savename'];
        //生成缩略图并保存
        $img = new \Think\Image();
        $server_img_path = UPLOAD_PATH . '/goods/' . $datas['goods_big_img'];
        $img->open($server_img_path);
        $img->thumb(60, 60)->save(UPLOAD_PATH . '/goods/' . $info['goods_big_img']['savepath'] . 'thumb_' . $info['goods_big_img']['savename']);
        //保存缩略图到数据库
        $datas['goods_thumb_img'] = $info['goods_big_img']['savepath'] . 'thumb_' . $info['goods_big_img']['savename'];
        return $datas;
    }

    public function _before_insert(&$datas)
    {
        $datas['created_time']=time();
    }
    public function _before_update(&$datas)
    {
        $datas['updated_time']=time();
    }
}