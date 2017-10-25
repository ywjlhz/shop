<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/17
 * Time: 10:01
 */

namespace Admin\Controller;


class GoodsController extends CommonController
{
    public function ajaxindex()
    {
        $model = D('Goods');
        $pageno = I('page');
        $totalPage = $model->where('display<>0')->count();
        $page = new \Think\Ajaxpage($totalPage, 2, $pageno);
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('first', '首页');
        $page->setConfig('last', '尾页');
        $page->lastSuffix = false;
        $paging = $page->ajaxshow();

        $datas = $model->field('a.*')
            ->alias('a')
            ->limit($page->firstRow, $page->listRows)
            ->where('a.display<>0')->select();


        $arr = array(
            'datas' => $datas,
            'paging' => $paging
        );

        if (I('page')) {
            $this->ajaxReturn($arr);
        } else {
            return $arr;
        }
    }

    public function index()
    {
        $model = D('Goods');
        $totalPage = $model->where('display<>0')->count();

//        总页数和每页显示条数
        $page = new \Think\Ajaxpage($totalPage, 2);
//        美化分页
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('first', '首页');
        $page->setConfig('last', '尾页');
        $page->lastSuffix = false;
//        展示分页
        $paging = $page->ajaxshow();
        $this->assign('paging', $paging);


        $datas = $model->field('a.*')
            ->alias('a')
            ->limit($page->firstRow, $page->listRows)
            ->where('a.display<>0')->select();
        $this->assign('datas', $datas);
        $this->display();
    }

    public function add()
    {
        //判断用户是否提交数据
        if (IS_POST) {
            //接收用户提交数据
            $datas = $_POST;
            //将商品写入数据库
            $res = D('Goods')->goodsAdd($datas);
            if ($res) {
                //商品入库成功则将商品属性写入属性值表
                $model = M('GoodsAttr');
                foreach ($datas['goods_attr_val'] as $key => $val) {
                    //键对应attribute表中的属性id
                    //写入商品的ID
                    $arr['goods_id'] = $res;
                    //写入商品的属性id
                    $arr['attr_id'] = $key;
                    //写入商品的属性值
                    $arr['goods_attr_value'] = implode(',',$val);
                    //写入商品到属性值表中
                    $model->add($arr);
                }
                $this->success('添加成功', U('index'));die;
            } else {
                $this->error('服务器繁忙请稍后再试...');die;
            }
        }
        //获取品牌和分类信息展示到页面中
        $this->assign('cate_data', D('Category')->getList());
        $this->assign('brand_data', D('Brand')->getList());
        //获得商品类型信息
        $this->assign('ctype_data', D('Cate')->getList());
        $this->display();
    }

    public function edit()
    {

        $id = I('id');
        if (IS_POST) {
            $datas = I('post.');
            $res = D('Goods')->goodsEdit($datas);
            if ($res) {
                $this->success('修改成功', U('index'));
                die;
            } else {
                $this->error('修改失败');
            }
        }
        $this->assign('goods_data', M('Goods')->where('display<>0')->find($id));
        $this->assign('cate_data', D('Category')->getList());
        $this->assign('brand_data', D('Brand')->getList());
        $this->display();
    }

    public function del()
    {
        $id = I('id');
        $model = D('Goods');
        $data = array('display' => 0, 'id' => $id);
        $rs = $model->save($data);
        if ($rs) {
            $this->ajaxReturn(array('status' => 1, 'msg' => '删除成功'));
        } else {
            $this->ajaxReturn(array('status' => 0, 'msg' => '删除失败'));
        }
    }

    public function goodsDisplay()
    {
        $id = I('id');
        $data = M('Goods')->find($id);
        $status = $data['display'];
        if ($status == 1) {
            $status = -1;
            $msg = '<font color="red">上架</font>';
        } else {
            $status = 1;
            $msg = '<font color="#9acd32">下架</font>';
        }
        $data['display'] = $status;
        $rs = M('Goods')->save($data);
        if($rs) {
            $this->ajaxReturn(array('status' => 1, 'msg' => $msg));
        }else {
            $this->ajaxReturn(array('status=>0','msg'=>'修改失败'));
        }
    }

    public function photos()
    {
        $id = I('id');
        $data = D('Goods')->find($id);
        $datas = M('GoodsImg')->where("goods_id=".$id)->select();
        $this->assign('data',$data);
        $this->datas = $datas;
        $this->display();
    }
    public function photosadd()
    {
        $goods_id = I('goods_id');
        if (!empty($_FILES['image']['name'][0])) {
            $res = uploadFile('GOODS_CONF');
            $img = new \Think\Image();
            foreach ($res['info'] as $key => $value) {
                $openName = UPLOAD_PATH . 'goods/' . $value['savepath'] . $value['savename'];
                $saveName = UPLOAD_PATH . 'goods/' . $value['savepath'] . 'thumb_' . $value['savename'];
                $img->open($openName);
                $img->thumb(60, 60)->save($saveName);
                $arr[$key]['big_img'] = $value['savepath'] . $value['savename'];
                $arr[$key]['thumb_img'] = $value['savepath'] . 'thumb_' . $value['savename'];
                $arr[$key]['goods_id'] = $goods_id;
            }
            $res = D('GoodsImg')->addAll($arr);
            if ($res) {
                $this->success('图片增加成功', U('photos',array('id'=>$goods_id)));die;
            } else {
                $this->error('图片增加失败');
            }
        }
    }
    public function photosdel()
    {
        $id = I('id');
        $data = M('GoodsImg')->find($id);
        $res = M('GoodsImg')->delete($id);
        if($res) {
            unlink(UPLOAD_PATH.'goods/'.$data['big_img']);
            unlink(UPLOAD_PATH.'goods/'.$data['thumb_img']);
            $this->ajaxReturn(array('status'=>0,'msg'=>'删除成功'));
        }else {
            $this->ajaxReturn(array('status'=>1,'msg'=>'删除失败'));
        }
    }
}
