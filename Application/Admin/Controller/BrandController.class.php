<?php
namespace Admin\Controller;
class BrandController extends CommonController
{
    public function index()
    {
        $model = M('Brand');
        $totalPage = $model->where('display<>0')->count();

//        总页数和每页显示条数
        $page = new \Think\Page($totalPage,3);
//        美化分页
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');

//        展示分页
        $paging = $page->show();
        $this->assign('paging',$paging);

        $datas = $model->where('display=1')->limit($page->firstRow,$page->listRows)->select();
        $this->assign('datas',$datas);
        $this->display();
    }
    public function add()
    {
        if(IS_POST) {
            $model = D('Brand');
            if(!($datas=$model->create())) {
                $this->error($model->getError());
            }
            $res = $model->add($datas);
            if($res) {
                $this->success('恭喜你提交成功',U('index'));die;
            }else {
                $this->error('操作失败');die;
            }
        }
        $this->display();
    }
    public function edit()
    {
        $model = D('Brand');
        if(IS_POST) {
            $datas = I('post.');
            $res = $model->save($datas);
            if($res) {
                $this->success('修改成功',U('index'));die;
            }else {
                $this->error('修改失败');die;
            }
        }
        $id=I('id');
        $datas = $model->find($id);
        $this->assign('datas',$datas);
        $this->display();
    }
//    public function del()
//    {
//        $id=I('id');
//        $model = M('Brand');
//        $res = $model->delete($id);
//        if($res) {
//            $this->success('修改成功',U('index'));die;
//        }else {
//            $this->error('修改失败');die;
//        }
//    }
    public function del()
    {
        $id=I('id');
        $model = M('Brand');
        $data = array('display'=>0,'id'=>$id);

        $rs = $model->save($data);
        if($rs) {
            echo 1;
        }else {
            echo '删除失败';
        }
    }
}