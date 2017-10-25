<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/17
 * Time: 11:41
 */

namespace Admin\Controller;


class CategoryController extends CommonController
{
    public function index()
    {
        $model = M('Category');

        $totalPage = $model->where('display<>0')->count();

//        总页数和每页显示条数
        $page = new \Think\Page($totalPage,5);
//        美化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');

//        展示分页
        $paging = $page->show();
        $this->assign('paging',$paging);

        $datas = $model->where('display<>0')->limit($page->firstRow,$page->listRows)->select();
        $datas = getTree($datas);
        foreach ($datas as $key=>$val) {
            $data = M('Category')->field('category_name')->where('display<>0')->find($val['pid']);
            $datas[$key]['pcate_name'] = $data['category_name'];
        }
        $this->assign('datas',$datas);
        $this->display();
    }
    public function add()
    {
        if(IS_POST) {
            $datas = I('post.');
            $res = D('Category')->add($datas);
            if($res) {
                $this->success('添加成功',U('index'));die;
            }else {
                $this->error('添加失败');die;
            }
        }
        $this->assign('datas',M('Category')->where('display<>0')->select());
        $this->display();
    }
    public function edit()
    {
        $datas = I('post.');
        $id=I('id');
        if(IS_POST) {
            $res = D('Category')->save($datas);
            if($res) {
                $this->success('修改成功',U('index'));die;
            }else {
                $this->error('修改失败');die;
            }
        }
        $this->assign('datas',M('Category')->where('display<>0')->select());
        $this->assign('data',M('Category')->where('display<>0')->find($id));
        $this->display();
    }
    public function del()
    {
        $id=I('id');
        $model = D('Category');
        $data = array('display'=>0,'id'=>$id);
        $rs = $model->save($data);
        if($rs) {
            echo 1;
        }else {
            echo '删除失败';
        }
    }

}