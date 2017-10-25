<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController   extends Controller
{
    public function login()
    {
        if(IS_POST) {
            $datas = I('post.');
            $model = M('Admin');
            $verify = new \Think\Verify();
            $res = $verify->check($datas['captcha']);
            if(!$res) {
                $this->error('验证码有误，请重新输入',U('login/login'));
            }
            $where = array('username'=>$datas['admin_user'],'password'=>md5($datas['admin_pwd']));
            $res = $model->where($where)->find();
            if($res) {
                session('login_info',$res);
                $time=time();
                $ip = ip2long($_SERVER['REMOTE_ADDR']);
                $count=$res['login_count']+1;
                $arr = array(
                    'id'=>$res['id'],
                    'last_time'=>$time,
                    'last_ip'=>$ip,
                    'login_count'=>$count,
                    'updated_time'=>$time
                );
                $model->save($arr);
                $this->success('登陆成功',U('index/index'));die;
            }else {
                $this->error('登陆失败',U('login/login'));die;
            }
        }
        $this->display();
    }
    public function captcha()
    {
        $config=array(
            // 中文验证码字符串
            'useImgBg'  =>  false,           // 使用背景图片
            'fontSize'  =>  14,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  30,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
            'bg'        =>  array(243, 251, 254),  // 背景颜色
            'reset'     =>  true,           // 验证成功后是否重置
        );
        $verify = new \Think\Verify($config);
        $verify->entry();
    }
}