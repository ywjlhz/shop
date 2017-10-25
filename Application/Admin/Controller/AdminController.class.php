<?php
/**
 * Created by PhpStorm.
 * User: Yang
 * Date: 2017/9/16
 * Time: 11:51
 */

namespace Admin\Controller;


class AdminController extends CommonController
{
    public function edit()
    {
        if(IS_POST) {
            $datas = I('post.');
            $model = M('Admin');
            $arr = array(
                'id' => $datas['admin_id'],
                'password' => md5($datas['admin_newpwd'])
            );
            $res = $model->save($arr);
            if($res) {
                session(null);
                $this->success('修改成功,请重新登录',U('login/login'),2);die;
            }else {
                $this->error('修改失败');die;
            }
        }
        $this->display();
    }
    public function yzpwd()
    {
        $datas = I('post.');
        $model = M('Admin');
        $res = $model->find($datas['id']);
        $pwd = md5($datas['oldpwd']);
        if($pwd==$res['password']) {
            echo json_encode(array('status'=>0,'msg'=>'<font color="#7cfc00">√</font>'));die;
        }else {
            echo json_encode(array('status'=>1,'msg'=>'<font color="red">与原密码不一致</font>'));die;
        }
    }
    public function quit()
    {
        session(null);
        if(!session('?login_info')) {
            $this->success('退出成功',U('login/login'),2);
        }
    }
}